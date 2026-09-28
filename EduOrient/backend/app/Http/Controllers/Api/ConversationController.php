<?php

namespace App\Http\Controllers\Api;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

/**
 * API messagerie : conversations 1-1 étudiant/recruteur, messages, lecture, diffusion temps réel (MessageSent).
 * Modèles : Conversation, Message, User (expéditeur).
 */
class ConversationController extends Controller
{
    /**
     * Liste les conversations de l’utilisateur avec dernier message et nombre de non lus.
     * Entrées : Request authentifiée (utilisateur étudiant ou recruteur).
     * Sortie : JSON { data: [...] } (résumés sérialisés).
     */
    public function index(Request $request): JsonResponse
    {
        $this->authorize('viewAny', Conversation::class);

        $user = $request->user();
        $query = Conversation::query()
            ->with([
                'candidat.user',
                'recruteur.user',
                'messages' => fn ($q) => $q->latest()->limit(1)->with('sender:id,name'),
            ])
            ->withCount([
                'messages as unread_count' => function ($q) use ($user) {
                    $q->where('sender_id', '!=', $user->id)->where('is_read', false);
                },
            ]);

        if (! $user->isEtudiant() && ! $user->isRecruteur()) {
            return response()->json(['message' => 'Profil introuvable pour la messagerie.'], 403);
        }

        $query->where(function ($q) use ($user) {
            $q->where('candidat_id', $user->id)
                ->orWhere('recruteur_id', $user->id);
        });

        $list = $query
            ->orderByRaw('COALESCE(last_message_at, updated_at) DESC')
            ->get();

        return response()->json([
            'data' => $list->map(fn (Conversation $c) => $this->serializeConversationSummary($c, $user)),
        ]);
    }

    /**
     * Crée ou retourne la conversation existante entre l’étudiant courant et un recruteur (ou l’inverse).
     * Entrées : body { recruteur_id } ou { candidat_id } selon le rôle.
     * Sortie : JSON 200/201 avec le résumé de conversation.
     */
    public function store(Request $request): JsonResponse
    {
        $this->authorize('create', Conversation::class);

        $user = $request->user();

        if ($user->isEtudiant()) {
            if (! $user->candidat) {
                return response()->json(['message' => 'Profil étudiant introuvable.'], 404);
            }
            $validated = $request->validate([
                'recruteur_id' => ['required', 'integer', 'exists:recruteurs,id'],
            ]);
            $candidatId = (int) $user->candidat->id;
            $recruteurId = (int) $validated['recruteur_id'];
        } elseif ($user->isRecruteur()) {
            if (! $user->recruteur) {
                return response()->json(['message' => 'Profil recruteur introuvable.'], 404);
            }
            $validated = $request->validate([
                'candidat_id' => ['required', 'integer', 'exists:candidats,id'],
            ]);
            $candidatId = (int) $validated['candidat_id'];
            $recruteurId = (int) $user->recruteur->id;
        } else {
            return response()->json(['message' => 'Accès refusé.'], 403);
        }

        $conversation = Conversation::query()->firstOrCreate(
            [
                'candidat_id' => $candidatId,
                'recruteur_id' => $recruteurId,
            ],
        );

        $conversation->load(['candidat.user', 'recruteur.user', 'latestMessage.sender']);

        return response()->json([
            'data' => $this->serializeConversationSummary($conversation, $user),
        ], $conversation->wasRecentlyCreated ? 201 : 200);
    }

    /**     * Retourne les données complètes d'une conversation (with other_user info).
     * Entrées : conversation (binding route), utilisateur authentifié (policy view).
     * Sortie : JSON { data: {...} }.
     */
    public function show(Request $request, Conversation $conversation): JsonResponse
    {
        $this->authorize('view', $conversation);

        $conversation->load(['candidat.user', 'recruteur.user', 'latestMessage.sender']);

        return response()->json([
            'data' => $this->serializeConversationSummary($conversation, $request->user()),
        ]);
    }

    /**     * Retourne tous les messages d’une conversation (ordre chronologique), avec l’expéditeur.
     * Entrées : conversation (binding route), utilisateur authentifié (policy view).
     * Sortie : JSON { data: messages[] }.
     */
    public function messages(Request $request, Conversation $conversation): JsonResponse
    {
        $this->authorize('view', $conversation);

        $rows = $conversation->messages()
            ->with('sender:id,name')
            ->orderBy('id')
            ->get();

        return response()->json([
            'data' => $rows->map(fn (Message $m) => $this->serializeMessage($m)),
        ]);
    }

    /**
     * Enregistre un nouveau message, met à jour last_message_at et diffuse l’événement WebSocket si configuré.
     * Entrées : body { content }, conversation, utilisateur authentifié (policy sendMessage).
     * Sortie : JSON 201 avec le message créé.
     */
    public function storeMessage(Request $request, Conversation $conversation): JsonResponse
    {
        $this->authorize('sendMessage', $conversation);

        $validated = $request->validate([
            'content' => ['required', 'string', 'max:5000'],
        ]);

        $message = $conversation->messages()->create([
            'sender_id' => $request->user()->id,
            'content' => $validated['content'],
        ]);

        $conversation->update(['last_message_at' => $message->created_at]);

        $message->load('sender:id,name');

        try {
            broadcast(new MessageSent($message));
        } catch (Throwable $e) {
            report($e);
        }

        return response()->json([
            'data' => $this->serializeMessage($message),
        ], 201);
    }

    /**
     * Marque comme lus tous les messages reçus (non envoyés par l'utilisateur) dans la conversation.
     */
    public function markAsRead(Request $request, Conversation $conversation): JsonResponse
    {
        $this->authorize('view', $conversation);

        $updated = Message::query()
            ->where('conversation_id', $conversation->id)
            ->where('sender_id', '!=', $request->user()->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json([
            'data' => [
                'marked' => $updated,
            ],
        ]);
    }

    /**
     * Nombre total de messages non lus à destination de l'utilisateur (toutes conversations).
     */
    public function unreadTotal(Request $request): JsonResponse
    {
        $this->authorize('viewAny', Conversation::class);

        $user = $request->user();
        $query = Message::query()
            ->where('sender_id', '!=', $user->id)
            ->where('is_read', false)
            ->whereHas('conversation', function ($qc) use ($user) {
                if ($user->isEtudiant() && $user->candidat) {
                    $qc->where('candidat_id', $user->candidat->id);
                } elseif ($user->isRecruteur() && $user->recruteur) {
                    $qc->where('recruteur_id', $user->recruteur->id);
                } else {
                    $qc->whereRaw('1 = 0');
                }
            });

        return response()->json([
            'unread_total' => $query->count(),
        ]);
    }

    /**
     * Transforme une Conversation Eloquent en tableau JSON pour la liste (contact, aperçu, non lus).
     * Entrées : conversation $c, utilisateur courant $me (pour déterminer « l’autre » partie).
     * Sortie : array associatif prêt pour response()->json.
     *
     * @return array<string, mixed>
     */
    private function serializeConversationSummary(Conversation $c, User $me): array
    {
        $last = null;
        if ($c->relationLoaded('messages')) {
            $last = $c->messages->first();
        }
        if (! $last) {
            $last = $c->relationLoaded('latestMessage')
                ? $c->latestMessage
                : $c->latestMessage()->with('sender:id,name')->first();
        }

        $otherUser = $me->isCandidatRole()
            ? $c->recruteur?->user
            : $c->candidat?->user;

        if (! $otherUser) {
            $otherUser = $me->isCandidatRole()
                ? User::find($c->recruteur_id)
                : User::find($c->candidat_id);
        }

        $company = $c->recruteur?->company;

        return [
            'id' => $c->id,
            'candidat_id' => $c->candidat_id,
            'recruteur_id' => $c->recruteur_id,
            'other_user' => $otherUser ? [
                'id' => $otherUser->id,
                'name' => $otherUser->name,
                'photo_url' => $otherUser->photo_url ?? null,
            ] : null,
            'entreprise' => $company?->name ?? $c->recruteur?->entreprise,
            'last_message' => $last ? [
                'content' => \Illuminate\Support\Str::limit((string) $last->content, 160),
                'sender_id' => $last->sender_id,
                'created_at' => $last->created_at?->toIso8601String(),
            ] : null,
            'last_message_at' => $c->last_message_at?->toIso8601String(),
            'updated_at' => $c->updated_at?->toIso8601String(),
            'unread_count' => (int) ($c->unread_count ?? 0),
        ];
    }

    /**
     * Transforme un Message en structure JSON pour le frontend.
     * Entrées : modèle Message $m (relation sender chargée si présente).
     * Sortie : array associatif.
     *
     * @return array<string, mixed>
     */
    private function serializeMessage(Message $m): array
    {
        return [
            'id' => $m->id,
            'conversation_id' => $m->conversation_id,
            'sender_id' => $m->sender_id,
            'content' => $m->content,
            'is_read' => (bool) $m->is_read,
            'created_at' => $m->created_at?->toIso8601String(),
            'sender' => $m->sender ? [
                'id' => $m->sender->id,
                'name' => $m->sender->name,
            ] : null,
        ];
    }
}

