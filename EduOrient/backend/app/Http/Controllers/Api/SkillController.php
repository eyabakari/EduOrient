<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Competence;
use Illuminate\Http\JsonResponse;

/**
 * Contrôleur API pour la liste des compétences (catalogue pour formulaires).
 */
class SkillController extends Controller
{
    /**
     * Liste toutes les compétences (pour sélection dans les formulaires).
     */
    public function index(): JsonResponse
    {
        $skills = Competence::query()
            ->orderBy('nom')
            ->get(['id', 'nom', 'categorie'])
            ->map(fn (Competence $competence) => $this->serializeCatalogSkill($competence));

        return response()->json(['data' => $skills]);
    }

    /**
     * Catalogue public des compétences (inscription recruteur, sans authentification).
     */
    public function publicCatalog(): JsonResponse
    {
        $skills = Competence::query()
            ->orderBy('categorie')
            ->orderBy('nom')
            ->get(['id', 'nom', 'categorie'])
            ->map(fn (Competence $competence) => $this->serializeCatalogSkill($competence));

        return response()->json(['data' => $skills]);
    }

    private function serializeCatalogSkill(Competence $competence): array
    {
        return [
            'id' => $competence->id,
            'name' => $competence->nom,
            'nom' => $competence->nom,
            'categorie' => $competence->categorie,
            'category' => $competence->categorie,
        ];
    }
}

