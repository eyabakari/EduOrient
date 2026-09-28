<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Candidat;
use App\Services\SkillMatchingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Recherche d'étudiants pour les recruteurs (filtres par compétence et spécialité).
 * Retourne la liste avec un score de correspondance (match) pour les critères de recherche.
 */
class SearchController extends Controller
{
    public function __construct(
        private SkillMatchingService $skillMatchingService
    ) {}

    /**
     * GET /api/search/suggested-students
     * Étudiants dont les compétences (profil + projets) intersectent les technologies entreprise
     * et les compétences requises des offres actives du recruteur ; tri par nombre de tags communs.
     */
    public function suggestedStudents(Request $request): JsonResponse
    {
        $user = $request->user();
        if (! $user || (! $user->isRecruteur() && ! $user->isAdmin())) {
            return response()->json([
                'message' => 'Accès réservé aux recruteurs et administrateurs.',
            ], 403);
        }

        $recruteur = $user->recruteur;
        if (! $recruteur) {
            return response()->json(['data' => []]);
        }

        try {
            $data = $this->skillMatchingService->getSuggestedStudentsForRecruiter($recruteur);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Le matching IA est indisponible.',
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 503);
        }

        return response()->json(['data' => $data]);
    }

    /**
     * GET /api/search/students?q=React+DSI
     * Barre de recherche unique : q est cherché dans les compétences (nom) et la spécialité (partial match).
     * Si q, skill et specialite sont vides, retourne tous les étudiants (user + skills chargés).
     * Réservé aux rôles recruteur et admin.
     */
    public function students(Request $request): JsonResponse
    {
        try {
            $q = $request->query('q');
            $q = is_string($q) ? trim($q) : '';
            $skill = $request->query('skill') ? trim((string) $request->query('skill')) : '';
            $specialite = $request->query('specialite') ? trim((string) $request->query('specialite')) : '';

            $terms = $q === '' ? [] : array_values(array_filter(array_map('trim', preg_split('/[\s,]+/', $q))));
            $hasFilters = $terms !== [] || $skill !== '' || $specialite !== '';

            $query = Candidat::query()
                ->select([
                    'candidats.id',
                    'candidats.linkedin',
                    'candidats.specialite',
                ])
                ->with([
                    'user:id,name,email,photo',
                    'skills' => fn ($q) => $q->select('competences.id', 'competences.nom', 'competences.nom', 'competences.categorie', 'competences.categorie'),
                ]);
            $query->withCount(['skills', 'projects']);

        if ($hasFilters) {
            if ($terms !== []) {
                $query->where(function ($qb) use ($terms) {
                    foreach ($terms as $term) {
                        $termLike = '%' . $term . '%';
                        $qb->orWhere(function ($q2) use ($termLike) {
                            // 1. Recherche par Skills
                            $q2->whereHas('skills', function ($q3) use ($termLike) {
                                $q3->where('nom', 'like', $termLike);
                            })
                            // 2. Recherche par Spécialité
                            ->orWhere('specialite', 'like', $termLike)
                            // 3. ZID HEDHI: Recherche par Nom/Prénom fil table Users
                            ->orWhereHas('user', function ($q4) use ($termLike) {
                                $q4->where('name', 'like', $termLike)
                                   ->orWhere('last_name', 'like', $termLike); // ken 3andek last_name
                            });
                        });
                    }
                });
            }
            if ($skill !== '') {
                $skillNames = array_filter(array_map('trim', explode(',', $skill)));
                if ($skillNames !== []) {
                    $query->whereHas('skills', function ($q) use ($skillNames) {
                        $q->whereIn('nom', $skillNames);
                    });
                }
            }
            if ($specialite !== '') {
                $query->where('specialite', 'like', '%' . $specialite . '%');
            }
        }

        $candidats = $query->get();

        $data = $candidats->map(function (Candidat $candidat) use ($terms) {
            $user = $candidat->user;
            $studentSkillNames = $candidat->skills->pluck('nom')->all();
            $top3 = $candidat->skills->take(3)->map(fn ($s) => ['id' => $s->id, 'nom' => $s->nom])->values()->all();

            $matchScore = $this->computeMatchScoreFromTerms(
                $studentSkillNames,
                $candidat->specialite,
                $terms
            );

            $photoUrl = null;
            if ($user && $user->photo) {
                try {
                    $photoUrl = url(\Illuminate\Support\Facades\Storage::disk('public')->url($user->photo));
                } catch (\Throwable) {
                    // ignorer si le stockage échoue
                }
            }

            return [
                'id' => $candidat->id,
                'name' => $user?->name ?? 'Étudiant',
                'email' => $user?->email,
                'photo_url' => $photoUrl,
                'linkedin' => $candidat->linkedin,
                'specialite' => $candidat->specialite,
                'top_3_skills' => $top3,
                'match_score' => round($matchScore, 1),
                'skills_count' => $candidat->skills_count ?? $candidat->skills->count(),
                'projects_count' => $candidat->projects_count ?? 0,
            ];
        });

        $data = $data->sortByDesc('match_score')->values()->all();

        return response()->json(['data' => $data]);
        } catch (\Throwable $e) {
            report($e);
            return response()->json([
                'message' => 'Erreur serveur lors de la recherche.',
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }

    /**
     * Score 0-100 : part des termes de recherche qui matchent (compétence ou spécialité).
     */
    private function computeMatchScoreFromTerms(array $studentSkillNames, ?string $studentSpecialite, array $terms): float
    {
        if ($terms === []) {
            return 100.0;
        }
        $matched = 0;
        $specialiteLower = mb_strtolower($studentSpecialite ?? '');
        foreach ($terms as $term) {
            $termLower = mb_strtolower($term);
            $skillMatch = ! empty(array_filter($studentSkillNames, fn ($n) => mb_stripos($n, $term) !== false || mb_stripos($term, $n) !== false));
            $specialiteMatch = $specialiteLower !== '' && mb_strpos($specialiteLower, $termLower) !== false;
            if ($skillMatch || $specialiteMatch) {
                $matched++;
            }
        }
        return ($matched / count($terms)) * 100.0;
    }

}

