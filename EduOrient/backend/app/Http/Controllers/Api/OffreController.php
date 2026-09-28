<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Offre;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * CRUD des offres de stage / emploi pour les recruteurs (compétences requises via skill_ids).
 */
class OffreController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();
        if (! $user) {
            return response()->json(['message' => 'Non authentifié.'], 401);
        }

        if ($user->isAdmin()) {
            $list = Offre::with(['skills', 'recruteur.user'])->latest()->get();

            return response()->json(['data' => $list]);
        }

        if (! $user->isRecruteur() || ! $user->recruteur) {
            return response()->json(['message' => 'Accès réservé aux recruteurs.'], 403);
        }

        $list = Offre::query()
            ->where('recruteur_id', $user->recruteur->id)
            ->with('skills')
            ->latest()
            ->get();

        return response()->json(['data' => $list]);
    }

    public function store(Request $request): JsonResponse
    {
        $user = $request->user();
        if (! $user || ! $user->isRecruteur() || ! $user->recruteur) {
            return response()->json(['message' => 'Accès réservé aux recruteurs.'], 403);
        }

        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|string|in:stage,emploi',
            'lieu' => 'nullable|string|max:255',
            'is_active' => 'sometimes|boolean',
            'skill_ids' => 'required|array|min:1',
            'skill_ids.*' => 'integer|exists:competences,id',
        ]);

        $offre = Offre::create([
            'recruteur_id' => $user->recruteur->id,
            'titre' => $validated['titre'],
            'description' => $validated['description'] ?? null,
            'type' => $validated['type'],
            'lieu' => $validated['lieu'] ?? null,
            'is_active' => $validated['is_active'] ?? true,
        ]);

        $offre->skills()->sync($validated['skill_ids']);
        $offre->load('skills');

        return response()->json(['data' => $offre], 201);
    }

    public function update(Request $request, Offre $offre): JsonResponse
    {
        $user = $request->user();
        if (! $user) {
            return response()->json(['message' => 'Non authentifié.'], 401);
        }

        if (! $this->canManageOffre($user, $offre)) {
            return response()->json(['message' => 'Action non autorisée.'], 403);
        }

        $validated = $request->validate([
            'titre' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'type' => 'sometimes|string|in:stage,emploi',
            'lieu' => 'nullable|string|max:255',
            'is_active' => 'sometimes|boolean',
            'skill_ids' => 'sometimes|array|min:1',
            'skill_ids.*' => 'integer|exists:competences,id',
        ]);

        $offre->fill(collect($validated)->except('skill_ids')->all());
        $offre->save();

        if (isset($validated['skill_ids'])) {
            $offre->skills()->sync($validated['skill_ids']);
        }

        $offre->load('skills');

        return response()->json(['data' => $offre]);
    }

    public function destroy(Request $request, Offre $offre): JsonResponse
    {
        $user = $request->user();
        if (! $user) {
            return response()->json(['message' => 'Non authentifié.'], 401);
        }

        if (! $this->canManageOffre($user, $offre)) {
            return response()->json(['message' => 'Action non autorisée.'], 403);
        }

        $offre->delete();

        return response()->json(['message' => 'Offre supprimée.']);
    }

    private function canManageOffre(\App\Models\User $user, Offre $offre): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->isRecruteur() && $user->recruteur && (int) $offre->recruteur_id === (int) $user->recruteur->id) {
            return true;
        }

        return false;
    }
}

