<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Offre;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Gestion globale des offres (stages / emplois) par l’admin : liste, visibilité, suppression.
 */
class AdminOffresController extends Controller
{
    /**
     * GET /api/admin/offres
     * Liste paginée de toutes les offres.
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = max(5, min((int) $request->input('per_page', 15), 50));
        $paginator = Offre::query()
            ->with(['recruteur.user', 'skills'])
            ->orderByDesc('created_at')
            ->paginate($perPage);

        $items = $paginator->getCollection()->map(function (Offre $offre) {
            $rec = $offre->recruteur;

            return [
                'id' => $offre->id,
                'titre' => $offre->titre,
                'description' => $offre->description,
                'type' => $offre->type,
                'lieu' => $offre->lieu,
                'is_active' => (bool) $offre->is_active,
                'created_at' => $offre->created_at?->toIso8601String(),
                'recruteur' => $rec ? [
                    'id' => $rec->id,
                    'entreprise' => $rec->entreprise,
                    'poste' => $rec->poste,
                    'user' => $rec->user ? [
                        'id' => $rec->user->id,
                        'name' => $rec->user->name,
                        'email' => $rec->user->email,
                    ] : null,
                ] : null,
                'skills' => $offre->skills->map(fn ($s) => ['id' => $s->id, 'nom' => $s->nom])->values()->all(),
            ];
        });

        return response()->json([
            'data' => $items,
            'meta' => [
                'current_page' => $paginator->currentPage(),
                'last_page' => $paginator->lastPage(),
                'per_page' => $paginator->perPage(),
                'total' => $paginator->total(),
            ],
        ]);
    }

    /**
     * PATCH /api/admin/offres/{id}
     * Active ou désactive une offre (modération).
     */
    public function updateActive(Request $request, int $id): JsonResponse
    {
        $validated = $request->validate([
            'is_active' => 'required|boolean',
        ]);

        $offre = Offre::query()->find($id);
        if (! $offre) {
            return response()->json(['message' => 'Offre introuvable.'], 404);
        }

        $offre->is_active = $validated['is_active'];
        $offre->save();
        $offre->load(['recruteur.user', 'skills']);

        $rec = $offre->recruteur;

        return response()->json([
            'data' => [
                'id' => $offre->id,
                'titre' => $offre->titre,
                'description' => $offre->description,
                'type' => $offre->type,
                'lieu' => $offre->lieu,
                'is_active' => (bool) $offre->is_active,
                'created_at' => $offre->created_at?->toIso8601String(),
                'recruteur' => $rec ? [
                    'id' => $rec->id,
                    'entreprise' => $rec->entreprise,
                    'poste' => $rec->poste,
                    'user' => $rec->user ? [
                        'id' => $rec->user->id,
                        'name' => $rec->user->name,
                        'email' => $rec->user->email,
                    ] : null,
                ] : null,
                'skills' => $offre->skills->map(fn ($s) => ['id' => $s->id, 'nom' => $s->nom])->values()->all(),
            ],
        ]);
    }

    /**
     * DELETE /api/admin/offres/{id}
     * Supprime une offre (modération).
     */
    public function destroy(int $id): JsonResponse
    {
        $offre = Offre::query()->find($id);
        if (! $offre) {
            return response()->json(['message' => 'Offre introuvable.'], 404);
        }

        $offre->delete();

        return response()->json(['message' => 'Offre supprimée.'], 200);
    }
}

