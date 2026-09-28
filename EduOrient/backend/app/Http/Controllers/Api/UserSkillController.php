<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Competence;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Compétences déclarées par l'étudiant (pivot etudiant_competence).
 */
class UserSkillController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $candidat = $request->user()->candidat;
        if (! $candidat) {
            return response()->json(['message' => 'Profil candidat requis.'], 403);
        }

        $skills = $candidat->skills()
            ->select('competences.id', 'competences.nom', 'competences.categorie')
            ->orderBy('nom')
            ->get()
            ->map(function ($skill) {
                $skill->setAttribute('pivot_level', $skill->pivot->level ?? 'beginner');
                $skill->setAttribute('name', $skill->nom);
                $skill->setAttribute('category', $skill->categorie);

                return $skill;
            });

        return response()->json(['data' => $skills]);
    }

    private const LEVELS = ['beginner', 'intermediate', 'expert'];

    public function store(Request $request): JsonResponse
    {
        $candidat = $request->user()->candidat;
        if (! $candidat) {
            return response()->json(['message' => 'Profil candidat requis.'], 403);
        }

        $request->validate([
            'skill_id' => ['nullable', 'integer', 'exists:competences,id'],
            'name' => ['nullable', 'string', 'max:255'],
            'level' => ['nullable', 'string', 'in:'.implode(',', self::LEVELS)],
        ], [], ['skill_id' => 'compétence', 'name' => 'nom', 'level' => 'niveau']);

        $level = in_array($request->input('level'), self::LEVELS, true)
            ? $request->input('level') : 'beginner';

        if ($request->filled('skill_id')) {
            $skillId = (int) $request->skill_id;
            if ($candidat->skills()->where('competences.id', $skillId)->exists()) {
                return response()->json(['message' => 'Cette compétence est déjà ajoutée.'], 422);
            }
            $candidat->skills()->attach($skillId, ['level' => $level]);
            $skill = Competence::find($skillId);
        } elseif ($request->filled('name')) {
            $name = trim($request->name);
            $skill = Competence::firstOrCreate(
                ['nom' => $name],
                ['categorie' => null]
            );
            if ($candidat->skills()->where('competences.id', $skill->id)->exists()) {
                return response()->json(['message' => 'Cette compétence est déjà ajoutée.'], 422);
            }
            $candidat->skills()->attach($skill->id, ['level' => $level]);
        } else {
            return response()->json(['message' => 'Indiquez skill_id ou name.'], 422);
        }

        $skill->setAttribute('pivot_level', $level);
        $skill->setAttribute('name', $skill->nom);
        $skill->setAttribute('category', $skill->categorie);

        return response()->json(['message' => 'Compétence ajoutée.', 'data' => $skill], 201);
    }

    public function destroy(Request $request, int $skill): JsonResponse
    {
        $candidat = $request->user()->candidat;
        if (! $candidat) {
            return response()->json(['message' => 'Profil candidat requis.'], 403);
        }

        $candidat->skills()->detach($skill);

        return response()->json(['message' => 'Compétence retirée.'], 200);
    }
}

