<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\SkillMatchingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Competence;

/**
 * Contrôleur API du matching étudiant ↔ entreprises / recruteurs.
 * Compare les compétences de l'étudiant (profil + projets) au périmètre techno des recruteurs (stack + offres actives).
 */
class RecommendationController extends Controller
{
    public function __construct(
        private SkillMatchingService $skillMatchingService
    ) {}

    /**
     * Suggestions de compétences à découvrir / à améliorer pour l'étudiant connecté.
     * Endpoint minimaliste utilisé côté mobile : GET /recommendations/missing-skills
     */
    public function missingSkills(Request $request): JsonResponse
    {
        $user = $request->user();
        if (! $user || ! $user->isEtudiant()) {
            return response()->json(['message' => 'Accès réservé aux étudiants.'], 403);
        }

        $candidat = $user->candidat;
        if (! $candidat) {
            return response()->json(['message' => 'Profil étudiant introuvable.'], 404);
        }

        try {
            $studentNames = $this->skillMatchingService->getStudentSkillNamesUnion($candidat);

            // Récupère les compétences connues en base et propose celles qui ne sont pas
            // encore dans le profil étudiant. C'est un fallback simple lorsque le moteur
            // IA n'est pas configuré.
            $all = Competence::query()->pluck('nom')->all();
            $missing = array_values(array_diff($all, $studentNames));

            // Limiter et formater la réponse attendue par le client mobile.
            $toDiscover = array_slice($missing, 0, 12);
            $toUpgrade = [];

            return response()->json([
                'data' => [
                    'to_discover' => array_map(fn($n) => ['id' => null, 'name' => $n], $toDiscover),
                    'to_upgrade' => $toUpgrade,
                ],
            ]);
        } catch (\Throwable $e) {
            Log::warning('missingSkills unavailable', ['exception' => $e->getMessage()]);
            return response()->json(['data' => ['to_discover' => [], 'to_upgrade' => []], 'message' => 'Indisponible'], 200);
        }
    }

    /**
     * Retourne les recruteurs / entreprises ayant au moins une compétence en commun avec l'étudiant connecté,
     * triés par nombre de tags communs (puis score d'adéquation).
     */
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();
        if (! $user || ! $user->isEtudiant()) {
            return response()->json([
                'message' => 'Accès réservé aux étudiants.',
            ], 403);
        }

        $candidat = $user->candidat;
        if (! $candidat) {
            return response()->json([
                'message' => 'Profil étudiant introuvable.',
            ], 404);
        }

        try {
            $matches = $this->skillMatchingService->getMatchedRecruitersForStudent($candidat);
        } catch (\Throwable $e) {
            Log::warning('Recommendations matching unavailable; returning empty payload.', [
                'exception' => $e->getMessage(),
            ]);

            return response()->json([
                'data' => [],
                'message' => 'Le matching IA est temporairement indisponible.',
                'error' => config('app.debug') ? $e->getMessage() : null,
            ]);
        }

        Log::info('RecommendationController@index payload', ['matches' => $matches]);

        return response()->json([
            'data' => $matches,
        ]);
    }

    /**
     * Offres actives (stage / emploi) dont les compétences requises (offre_competence) intersectent
     * le profil étudiant (compétences déclarées + projets), triées par adéquation.
     */
    public function offres(Request $request): JsonResponse
    {
        $user = $request->user();
        if (! $user || ! $user->isEtudiant()) {
            return response()->json([
                'message' => 'Accès réservé aux étudiants.',
            ], 403);
        }

        $candidat = $user->candidat;
        if (! $candidat) {
            return response()->json([
                'message' => 'Profil étudiant introuvable.',
            ], 404);
        }

        try {
            $offres = $this->skillMatchingService->getMatchedOffersForStudent($candidat);
        } catch (\Throwable $e) {
            Log::warning('Offer recommendations matching unavailable; returning empty payload.', [
                'exception' => $e->getMessage(),
            ]);

            return response()->json([
                'data' => [],
                'message' => 'Le matching IA est temporairement indisponible.',
                'error' => config('app.debug') ? $e->getMessage() : null,
            ]);
        }

        Log::info('RecommendationController@offres payload', ['offres' => $offres]);

        return response()->json([
            'data' => $offres,
        ]);
    }
}

