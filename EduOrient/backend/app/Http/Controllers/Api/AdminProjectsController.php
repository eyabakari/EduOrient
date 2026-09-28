<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Modération des projets par l'admin : liste globale, suppression.
 */
class AdminProjectsController extends Controller
{
    /**
     * GET /api/admin/projects
     * Liste paginée de tous les projets (tous les étudiants).
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = max(5, min((int) $request->input('per_page', 15), 50));
        $projects = Project::with(['candidat.user', 'skills'])
            ->orderByDesc('created_at')
            ->paginate($perPage);

        $items = $projects->getCollection()->map(function ($project) {
            return [
                'id' => $project->id,
                'titre' => $project->titre,
                'description' => $project->description,
                'lien_github' => $project->lien_github,
                'lien_demo' => $project->lien_demo,
                'image_url' => $project->image_url,
                'date_debut' => $project->date_debut?->format('Y-m-d'),
                'date_fin' => $project->date_fin?->format('Y-m-d'),
                'created_at' => $project->created_at?->toIso8601String(),
                'candidat' => $project->candidat ? [
                    'id' => $project->candidat->id,
                    'user' => $project->candidat->user ? [
                        'id' => $project->candidat->user->id,
                        'name' => $project->candidat->user->name,
                        'email' => $project->candidat->user->email,
                    ] : null,
                ] : null,
                'skills' => $project->skills->map(fn ($s) => ['id' => $s->id, 'nom' => $s->nom])->values()->all(),
            ];
        });

        return response()->json([
            'data' => $items,
            'meta' => [
                'current_page' => $projects->currentPage(),
                'last_page' => $projects->lastPage(),
                'per_page' => $projects->perPage(),
                'total' => $projects->total(),
            ],
        ]);
    }

    /**
     * DELETE /api/admin/projects/{id}
     * Supprime un projet (modération).
     */
    public function destroy(int $id): JsonResponse
    {
        $project = Project::find($id);
        if (! $project) {
            return response()->json(['message' => 'Projet introuvable.'], 404);
        }

        $project->delete();
        return response()->json(['message' => 'Projet supprimé.'], 200);
    }
}

