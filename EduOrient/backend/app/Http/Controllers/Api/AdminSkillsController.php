<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Competence;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Gestion du dictionnaire des compétences par l'admin : liste, renommage, suppression.
 */
class AdminSkillsController extends Controller
{
    /**
     * GET /api/admin/skills
     * Liste paginée de toutes les compétences (avec comptages d'usage).
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = max(5, min((int) $request->input('per_page', 20), 100));
        // Plus récent en premier : après un POST, la compétence créée reste visible sur la page 1
        // (évite l’effet « ajout invisible » avec un tri strictement alphabétique + pagination).
        $skills = Competence::withCount(['candidats', 'projects'])
            ->orderByDesc('id')
            ->paginate($perPage);

        return response()->json([
            'data' => $skills->items(),
            'meta' => [
                'current_page' => $skills->currentPage(),
                'last_page' => $skills->lastPage(),
                'per_page' => $skills->perPage(),
                'total' => $skills->total(),
            ],
        ]);
    }

    /**
     * GET /api/admin/skills/categories
     * Retourne la liste unique et triée des catégories de compétences.
     */
    public function categories(): JsonResponse
    {
        $cats = Competence::query()
            ->whereNotNull('categorie')
            ->where('categorie', '!=', '')
            ->distinct()
            ->pluck('categorie')
            ->map(fn($c) => trim((string) $c))
            ->unique()
            ->sortBy(fn($c) => mb_strtolower($c))
            ->values()
            ->all();

        return response()->json(['data' => $cats]);
    }

    /**
     * POST /api/admin/skills
     * Crée une nouvelle compétence avec nom et catégorie.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'categorie' => ['required', 'string', 'max:255'],
        ], [], [
            'nom' => 'nom de la compétence',
            'categorie' => 'catégorie',
        ]);

        $categorie = trim($request->categorie);
        $nom = trim($request->nom);

        $existing = Competence::query()
            ->where('categorie', $categorie)
            ->where('nom', $nom)
            ->first();
        if ($existing) {
            return response()->json([
                'message' => 'Une compétence avec ce nom et cette catégorie existe déjà.',
            ], 422);
        }

        $skill = Competence::create([
            'nom' => $nom,
            'categorie' => $categorie,
        ]);
        $skill->loadCount(['candidats', 'projects']);

        return response()->json([
            'message' => 'Compétence ajoutée.',
            'data' => $skill,
        ], 201);
    }

    /**
     * PUT /api/admin/skills/{id}
     * Met à jour le nom et/ou la catégorie d'une compétence.
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'categorie' => ['required', 'string', 'max:255'],
        ], [], [
            'nom' => 'nom de la compétence',
            'categorie' => 'catégorie',
        ]);

        $skill = Competence::find($id);
        if (! $skill) {
            return response()->json(['message' => 'Compétence introuvable.'], 404);
        }

        $categorie = trim($request->categorie);
        $nom = trim($request->nom);
        $skill->update([
            'nom' => $nom,
            'categorie' => $categorie,
        ]);

        return response()->json([
            'message' => 'Compétence mise à jour.',
            'data' => $skill,
        ]);
    }

    /**
     * DELETE /api/admin/skills/{id}
     * Supprime une compétence du dictionnaire (détache des projets et étudiants).
     */
    public function destroy(int $id): JsonResponse
    {
        $skill = Competence::find($id);
        if (! $skill) {
            return response()->json(['message' => 'Compétence introuvable.'], 404);
        }

        $skill->candidats()->detach();
        $skill->projects()->detach();
        $skill->delete();

        return response()->json(['message' => 'Compétence supprimée.'], 200);
    }
}


