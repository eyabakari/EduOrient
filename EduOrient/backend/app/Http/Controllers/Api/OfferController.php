<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\User;
use App\Services\SkillMatchingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * API « offers » : publication (store) et matching étudiants pour une offre donnée.
 * Les colonnes en base restent titre / recruteur_id ; le champ JSON `title` est accepté comme alias de `titre`.
 */
class OfferController extends Controller
{
    public function __construct(
        private SkillMatchingService $skillMatchingService
    ) {}

    public function store(Request $request): JsonResponse
    {
        $user = $request->user();
        if (! $user || ! $user->isRecruteur() || ! $user->recruteur) {
            return response()->json(['message' => 'Accès réservé aux recruteurs.'], 403);
        }

        if ($request->filled('title') && ! $request->filled('titre')) {
            $request->merge(['titre' => $request->input('title')]);
        }

        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|string|in:stage,emploi',
            'lieu' => 'nullable|string|max:255',
            'is_active' => 'sometimes|boolean',
            'competence_ids' => 'sometimes|array|min:1',
            'competence_ids.*' => 'integer|exists:competences,id',
            'skill_ids' => 'sometimes|array|min:1',
            'skill_ids.*' => 'integer|exists:competences,id',
        ]);

        $competenceIds = $validated['competence_ids'] ?? $validated['skill_ids'] ?? [];
        if (empty($competenceIds)) {
            return response()->json(['message' => 'Aucune competence fournie.'], 422);
        }

        $offer = Offer::create([
            'recruteur_id' => $user->recruteur->id,
            'titre' => $validated['titre'],
            'description' => $validated['description'] ?? null,
            'type' => $validated['type'],
            'lieu' => $validated['lieu'] ?? null,
            'is_active' => $validated['is_active'] ?? true,
        ]);

        $offer->competences()->sync($competenceIds);
        $offer->load('competences');

        return response()->json(['data' => $offer], 201);
    }

    /**
     * Étudiants dont le profil (compétences déclarées + projets) recoupe les compétences requises de l'offre,
     * triés par score de correspondance (pourcentage du nombre de compétences offre couvertes).
     */
    public function getMatchingStudents(Request $request, Offer $offer): JsonResponse
    {
        $user = $request->user();
        if (! $user) {
            return response()->json(['message' => 'Non authentifié.'], 401);
        }

        if (! $this->canAccessOfferMatching($user, $offer)) {
            return response()->json(['message' => 'Action non autorisée.'], 403);
        }

        try {
            $rows = $this->skillMatchingService->getMatchingStudentsForOffer($offer);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Le matching est indisponible.',
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 503);
        }

        return response()->json(['data' => $rows]);
    }

    private function canAccessOfferMatching(User $user, Offer $offer): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->isRecruteur() && $user->recruteur && (int) $offer->recruteur_id === (int) $user->recruteur->id) {
            return true;
        }

        return false;
    }
}

