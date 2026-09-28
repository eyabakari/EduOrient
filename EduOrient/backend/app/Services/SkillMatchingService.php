<?php

namespace App\Services;

use App\Models\Competence;
use App\Models\Candidat;
use App\Models\Offre;
use App\Models\Recruteur;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/** Matching semantique via Groq entre profils candidats, offres et entreprises. */
class SkillMatchingService
{
    private const MATCHING_CACHE_TTL_SECONDS = 86400;

    /**
     * Union des noms de compétences : profil étudiant + projets portfolio (utilise les relations francisées).
     *
     * @return list<string>
     */
    public function getStudentSkillNamesUnion(Candidat $candidat): array
    {
        if ($candidat->relationLoaded('competences')) {
            $direct = $candidat->competences->pluck('nom')->all();
        } else {
            $direct = $candidat->competences()->pluck('nom')->all();
        }

        $fromProjects = [];
        if ($candidat->relationLoaded('projets')) {
            foreach ($candidat->projets as $project) {
                if ($project->relationLoaded('competences')) {
                    $names = $project->competences->pluck('nom')->all();
                } else {
                    $names = $project->competences()->pluck('nom')->all();
                }
                $fromProjects = array_merge($fromProjects, $names);
            }
        } else {
            foreach ($candidat->projets()->with('competences')->get() as $project) {
                $fromProjects = array_merge($fromProjects, $project->competences->pluck('nom')->all());
            }
        }

        return array_values(array_unique(array_merge($direct, $fromProjects)));
    }

    /**
     * Noms de compétences cibles pour un recruteur : technologies entreprise ∪ compétences de toutes ses offres actives.
     *
     * @return list<string>
     */
    public function getRecruiterTargetSkillNames(Recruteur $recruteur): array
    {
        if ($recruteur->relationLoaded('competences') && $recruteur->relationLoaded('offres')) {
            $fromCompany = $recruteur->competences->pluck('nom')->all();
            $fromOffers = [];
            foreach ($recruteur->offres as $offre) {
                if (! $offre->is_active) {
                    continue;
                }
                if ($offre->relationLoaded('competences')) {
                    $fromOffers = array_merge($fromOffers, $offre->competences->pluck('nom')->all());
                }
            }

            return array_values(array_unique(array_merge($fromCompany, $fromOffers)));
        }

        $fromCompany = $recruteur->competences()->pluck('nom')->all();
        $fromOffers = Competence::query()
            ->whereHas('offres', function ($q) use ($recruteur) {
                $q->where('recruteur_id', $recruteur->id)->where('is_active', true);
            })
            ->pluck('nom')
            ->all();

        return array_values(array_unique(array_merge($fromCompany, $fromOffers)));
    }

    /**
     * Offres actives avec matching ultra-simple et défensif.
     * Score = (nombre de compétences communes / nombre de compétences requises) * 100
     * Retourne uniquement les offres avec au moins une compétence commune.
     *
     * @return list<array<string, mixed>>
     */
    public function getMatchedOffersForStudent(Candidat $candidat): array
    {
        // Étape 1 : Récupérer les IDs des compétences du candidat (profil seulement)
        $directCompetenceIds = $candidat->competences()
            ->pluck('competences.id')
            ->toArray();

        // Étape 2 : Ajouter les compétences des projets (requête séparée pour éviter N+1)
        $projectCompetenceIds = $candidat->projets()
            ->with('competences:id')
            ->get()
            ->flatMap(fn ($projet) => $projet->competences->pluck('id'))
            ->toArray();

        // Étape 3 : Fusionner et dédupliquer les IDs de compétences
        $allStudentCompetenceIds = array_unique(array_merge($directCompetenceIds, $projectCompetenceIds));

        if (empty($allStudentCompetenceIds)) {
            return [];
        }

        // Étape 4 : Récupérer UNIQUEMENT les offres qui partagent au moins une compétence
        $offres = Offre::query()
            ->where('is_active', true)
            ->whereHas('competences', function ($q) use ($allStudentCompetenceIds) {
                $q->whereIn('competences.id', $allStudentCompetenceIds);
            })
            ->with([
                'competences:id,nom',
                'recruteur:id,entreprise,poste',
                'recruteur.user:id,name,email',
            ])
            ->get();

        // Étape 5 : Calculer le score et formater les résultats
        $result = [];
        foreach ($offres as $offre) {
            $totalRequired = $offre->competences->count();
            $commonCount = $offre->competences
                ->whereIn('id', $allStudentCompetenceIds)
                ->count();

            $score = $totalRequired > 0 ? round(($commonCount / $totalRequired) * 100) : 0;

            // Construire une justification détaillée et professionnelle pour le frontend
            $competencesOffreNoms = $offre->competences->pluck('nom')->toArray();
            $competencesCandidatNoms = $candidat->competences->whereIn('id', $offre->competences->pluck('id'))->pluck('nom')->toArray();
            $competencesManquantesNoms = array_values(array_diff($competencesOffreNoms, $competencesCandidatNoms));

            $nomEntreprise = $offre->recruteur?->entreprise ?? 'cette entreprise';
            $titreOffre = $offre->titre ?? 'cette opportunité';
            $competencesCommunes = $offre->competences
                ->whereIn('id', $allStudentCompetenceIds)
                ->pluck('nom')
                ->unique()
                ->values()
                ->all();

            $justificationMetier = "Recommandation ProLink : Cette opportunité a été sélectionnée car " . $nomEntreprise . " recherche activement un profil spécialisé en [" . implode(', ', $competencesCommunes) . "], ce qui correspond parfaitement à la stack technique validée dans votre portfolio. ";

            if ($score >= 80) {
                $justificationMetier .= "Avec un score de " . $score . "%, votre profil se positionne parmi les candidats hautement qualifiés pour propulser leurs projets innovants.";
            } else {
                $justificationMetier .= "En postulant, vous valorisez vos compétences clés tout en ayant l'opportunité de vous développer sur les technologies complémentaires de l'annonce.";
            }

            $result[] = [
                'id' => $offre->id,
                'titre' => $offre->titre,
                'description' => $offre->description,
                'type' => $offre->type,
                'lieu' => $offre->lieu,
                'entreprise' => $offre->recruteur?->company?->name ?? $offre->recruteur?->entreprise,
                   'entreprise' => $offre->recruteur?->entreprise,
                'recruteur_id' => $offre->recruteur?->id,
                'recruteur' => [
                    'nom' => $offre->recruteur?->user?->name,
                    'poste' => $offre->recruteur?->poste,
                    'email' => $offre->recruteur?->user?->email,
                ],
                'common_competences_count' => $commonCount,
                'required_competences_count' => $totalRequired,
                'score' => $score,
                'source' => 'simple_matching',
                'justification' => $this->limitText((string) $justificationMetier, 1000),
            ];
        }

        // Étape 6 : Trier par score décroissant
        usort($result, fn ($a, $b) => $b['score'] <=> $a['score']);

        return $result;
    }

    /**
     * Alias pour getMatchedOffersForStudent().
     *
     * @return list<array<string, mixed>>
     */
    public function getSuggestedOffers(Candidat $candidat): array
    {
        return $this->getMatchedOffersForStudent($candidat);
    }

    /**
     * Entreprises/recruteurs avec au moins une compétence commune avec l'étudiant.
     * Score basé sur l'intersection du stack entreprise et des compétences étudiantes.
     *
     * @return list<array<string, mixed>>
     */
    public function getMatchedRecruitersForStudent(Candidat $candidat): array
    {
        // Étape 1 : Récupérer les IDs des compétences du candidat
        $directCompetenceIds = $candidat->competences()
            ->pluck('competences.id')
            ->toArray();

        // Étape 2 : Ajouter les compétences des projets
        $projectCompetenceIds = [];
        foreach ($candidat->projets as $projet) {
            $ids = $projet->competences()->pluck('competences.id')->toArray();
            $projectCompetenceIds = array_merge($projectCompetenceIds, $ids);
        }

        $allStudentCompetenceIds = array_unique(array_merge($directCompetenceIds, $projectCompetenceIds));

        if (empty($allStudentCompetenceIds)) {
            return [];
        }

        // Étape 3 : Récupérer les recruteurs ayant au moins une compétence commune
        $recruteurs = Recruteur::query()
            ->whereHas('competences', function ($q) use ($allStudentCompetenceIds) {
                $q->whereIn('competences.id', $allStudentCompetenceIds);
            })
            ->orWhereHas('offres', function ($q) use ($allStudentCompetenceIds) {
                $q->where('is_active', true)
                    ->whereHas('competences', function ($q2) use ($allStudentCompetenceIds) {
                        $q2->whereIn('competences.id', $allStudentCompetenceIds);
                    });
            })
            ->with([
                'competences:id,nom',
                'user:id,name,email',
                'offres' => fn ($q) => $q->where('is_active', true)->with('competences:id,nom'),
            ])
            ->get();

        // Étape 4 : Calculer le score pour chaque recruteur
        $result = [];
        foreach ($recruteurs as $recruteur) {
            // Compétences du recruteur
            $recruiterCompetenceIds = $recruteur->competences->pluck('id')->toArray();

            // Ajouter les compétences des offres actives
            foreach ($recruteur->offres as $offre) {
                $recruiterCompetenceIds = array_merge($recruiterCompetenceIds, $offre->competences->pluck('id')->toArray());
            }

            $recruiterCompetenceIds = array_unique($recruiterCompetenceIds);
            $commonCount = count(array_intersect($allStudentCompetenceIds, $recruiterCompetenceIds));
            $totalRecruiterSkills = count($recruiterCompetenceIds);

            // Ignorer si aucune compétence commune
            if ($commonCount === 0) {
                continue;
            }

            $score = $totalRecruiterSkills > 0 ? round(($commonCount / $totalRecruiterSkills) * 100) : 0;

            $nomEntreprise = $recruteur->entreprise ?? 'cette entreprise';
            $recruiterSkills = $recruteur->competences->concat($recruteur->offres->flatMap(fn ($o) => $o->competences))->unique('id');
            $matchedSkillNames = $recruiterSkills
                ->whereIn('id', $allStudentCompetenceIds)
                ->pluck('nom')
                ->unique()
                ->values()
                ->all();
            $missingSkillNames = $recruiterSkills
                ->whereNotIn('id', $allStudentCompetenceIds)
                ->pluck('nom')
                ->unique()
                ->values()
                ->all();

            $justificationMetier = "Recommandation ProLink : " . $nomEntreprise . " est recommandée car elle présente un périmètre technologique compatible avec votre profil, notamment sur [" . implode(', ', $matchedSkillNames) . "]. ";
            if ($score >= 80) {
                $justificationMetier .= "Avec un score de " . $score . "%, vous apparaissez comme un candidat très bien positionné pour contribuer à leurs projets stratégiques.";
            } else {
                $justificationMetier .= "En vous rapprochant de cette entreprise, vous valorisez vos compétences clés tout en renforçant votre attractivité sur les compétences complémentaires qu'elle recherche.";
            }

            if (! empty($missingSkillNames)) {
                $justificationMetier .= " Pour améliorer encore votre profil face à leurs besoins, enrichissez votre portfolio sur : [" . implode(', ', $missingSkillNames) . "].";
            }

            $result[] = [
                'recruteur_id' => $recruteur->id,
                   'entreprise' => $recruteur->entreprise,
                   'ville' => $recruteur->ville,
                   'gouvernorat' => $recruteur->gouvernorat,
                   'description' => $recruteur->description,
                'recruteur' => [
                    'nom' => $recruteur->user?->name,
                    'poste' => $recruteur->poste,
                    'email' => $recruteur->user?->email,
                ],
                'stack_tags' => $recruteur->competences->pluck('nom')->merge(
                    $recruteur->offres->flatMap(fn ($o) => $o->competences->pluck('nom'))
                )->unique()->values()->all(),
                'common_competences_count' => $commonCount,
                'recruiter_competences_count' => $totalRecruiterSkills,
                'score' => $score,
                'source' => 'simple_matching',
                'justification' => $this->limitText((string) $justificationMetier, 1000),
            ];
        }

        // Étape 5 : Trier par score décroissant
        usort($result, fn ($a, $b) => $b['score'] <=> $a['score']);

        return $result;
    }

    /**
     * Alias pour getMatchedRecruitersForStudent().
     *
     * @return list<array<string, mixed>>
     */
    public function getSuggestedCompanies(Candidat $candidat): array
    {
        return $this->getMatchedRecruitersForStudent($candidat);
    }

    private function aiMatchingEnabled(): bool
    {
        return filled((string) config('services.groq.api_key')) || filled((string) config('services.huggingface.api_key'));
    }

    private function ensureAiMatchingConfigured(): void
    {
        if (! $this->aiMatchingEnabled()) {
            Log::warning('Aucune cle IA configuree pour le matching; fallback local utilise.');
        }
    }

    private function getExactSkillOverlap(array $sourceNames, array $targetNames): array
    {
        $sourceSet = array_flip($sourceNames);

        return array_values(array_unique(array_filter($targetNames, fn ($name) => isset($sourceSet[$name]))));
    }

    private function buildStudentProfileText(Candidat $candidat): string
    {
        $candidat->loadMissing(['competences', 'projets.competences']);

        $lines = [
            'Biographie: ' . ($candidat->bio ?: 'Non renseignee'),
            'Specialite: ' . ($candidat->specialite ?: 'Non renseignee'),
            'Technologies declarees: ' . $this->joinNames($candidat->competences->pluck('nom')->all()),
            'Projets:',
        ];

        foreach ($candidat->projets as $project) {
            $lines[] = sprintf(
                '- %s | Description: %s | Stack: %s',
                $project->titre ?: 'Sans titre',
                $project->description ?: 'Non renseignee',
                $this->joinNames($project->competences->pluck('nom')->all())
            );
        }

        return $this->limitText(implode("\n", $lines), 6000);
    }

    private function buildOfferTargetText(Offre $offre): string
    {
        $offre->loadMissing(['competences', 'recruteur.company', 'recruteur.competences', 'recruteur.offres.competences']);

        $rec = $offre->recruteur;
        $company = $rec?->company;
        $otherOffers = [];

        foreach (($rec?->offres ?? []) as $other) {
            if ((int) $other->id === (int) $offre->id || ! $other->is_active) {
                continue;
            }
            $otherOffers[] = sprintf(
                '- %s | %s | Stack: %s',
                $other->titre ?: 'Offre sans titre',
                $other->description ?: 'Description non renseignee',
                $this->joinNames($other->competences->pluck('nom')->all())
            );
        }

        return $this->limitText(implode("\n", [
            'Type de cible: Offre',
            'Titre offre: ' . ($offre->titre ?: 'Non renseigne'),
            'Type: ' . ($offre->type ?: 'Non renseigne'),
            'Lieu: ' . ($offre->lieu ?: 'Non renseigne'),
            'Description complete offre: ' . ($offre->description ?: 'Non renseignee'),
            'Technologies requises offre: ' . $this->joinNames($offre->competences->pluck('nom')->all()),
            'Entreprise: ' . ($company?->name ?? $rec?->entreprise ?? 'Non renseignee'),
            'Domaine / description entreprise: ' . ($company?->description ?: 'Non renseigne'),
            'Stack entreprise: ' . $this->joinNames($rec?->competences?->pluck('nom')->all() ?? []),
            'Autres offres / projets de recrutement entreprise:',
            implode("\n", array_slice($otherOffers, 0, 5)) ?: 'Non renseigne',
        ]), 6000);
    }

    private function buildRecruiterTargetText(Recruteur $recruteur, array $targetNames): string
    {
        $recruteur->loadMissing(['competences', 'company', 'offres.competences']);

        $offers = [];
        foreach ($recruteur->offres as $offre) {
            if (! $offre->is_active) {
                continue;
            }
            $offers[] = sprintf(
                '- %s | Type: %s | Lieu: %s | Description: %s | Stack: %s',
                $offre->titre ?: 'Offre sans titre',
                $offre->type ?: 'Non renseigne',
                $offre->lieu ?: 'Non renseigne',
                $offre->description ?: 'Non renseignee',
                $this->joinNames($offre->competences->pluck('nom')->all())
            );
        }

        return $this->limitText(implode("\n", [
            'Type de cible: Entreprise',
            'Entreprise: ' . ($recruteur->company?->name ?? $recruteur->entreprise ?? 'Non renseignee'),
            'Domaine / description entreprise: ' . ($recruteur->company?->description ?: 'Non renseigne'),
            'Ville: ' . ($recruteur->company?->ville ?: 'Non renseignee'),
            'Gouvernorat: ' . ($recruteur->company?->gouvernorat ?: 'Non renseigne'),
            'Poste recruteur: ' . ($recruteur->poste ?: 'Non renseigne'),
            'Stack entreprise et offres: ' . $this->joinNames($targetNames),
            'Offres actives / projets de recrutement:',
            implode("\n", array_slice($offers, 0, 8)) ?: 'Non renseigne',
        ]), 6000);
    }

    /**
     * @return array{score_offre: float, score_entreprise: float, justification: string}
     */
    private function analyzeSemanticMatch(string $studentProfileText, string $targetText, string $targetType, ?int $studentId = null, ?int $targetId = null): array
    {
        $system = <<<'PROMPT'
Tu es un expert en recrutement. Analyse les competences de l'etudiant et les offres. Retourne TOUJOURS un tableau JSON d'objets, meme si le score est bas. Chaque objet doit avoir : 'score_offre', 'score_entreprise', 'justification'.
Si le tableau est vide, renvoie un tableau contenant un seul objet avec score_offre 0, score_entreprise 0 et une justification.
RETOURNE UNIQUEMENT LE JSON. NE RECOIS AUCUNE INTRODUCTION NI CONCLUSION NI EXPLICATION.
PROMPT;

        $user = <<<PROMPT
Profil etudiant:
{$studentProfileText}

Cible ({$targetType}):
{$targetText}

Consignes:
- score_offre: adequation de 0 a 100 entre les projets/competences de l'etudiant et les besoins explicites de l'offre.
- score_entreprise: compatibilite de 0 a 100 entre le profil etudiant et le domaine/stack globale de l'entreprise.
- justification: 1 a 2 phrases concises en francais expliquant les scores.
PROMPT;

        $cacheKey = $this->matchingCacheKey($studentProfileText, $targetText, $targetType, $studentId, $targetId);
        $cached = Cache::get($cacheKey);
        if (is_array($cached)) {
            Log::info('Matching IA servi depuis le cache', ['cache_key' => $cacheKey]);

            return $this->normalizeAiResult($cached);
        }

        $prompt = trim($system) . "\n\n" . trim($user);

        foreach (['groq', 'huggingface'] as $provider) {
            try {
                $content = $provider === 'groq'
                    ? $this->callGroq($prompt)
                    : $this->callHuggingFace($prompt);

                if ($content === null) {
                    continue;
                }

                $parsed = $this->parseAiContent($content, $provider);
                if ($parsed !== null) {
                    Cache::put($cacheKey, $parsed, now()->addSeconds(self::MATCHING_CACHE_TTL_SECONDS));

                    return $parsed;
                }
            } catch (\Throwable $e) {
                Log::warning($provider . ' semantic matching failed; trying fallback if available.', [
                    'exception' => $e->getMessage(),
                ]);
            }
        }

        return $this->mockAiResult();
    }

    private function matchingCacheKey(string $studentProfileText, string $targetText, string $targetType, ?int $studentId, ?int $targetId): string
    {
        if ($studentId !== null && $targetId !== null) {
            return 'matching_' . $targetType . '_' . $studentId . '_' . $targetId;
        }

        return sprintf(
            'skill_matching_%s',
            hash('sha256', $studentProfileText . "\n" . $targetText . "\n" . $targetType)
        );
    }

    private function callGroq(string $prompt): ?string
    {
        $apiKey = $this->sanitizeApiKey((string) config('services.groq.api_key'), 'Groq');
        if ($apiKey === '') {
            return null;
        }

        if ((bool) config('services.groq.matching_sleep_in_loop', false)) {
            sleep(1);
        }

        Log::info('Appel API Groq lance');

        $response = Http::retry(1, 1500, function ($exception) {
            if ($exception instanceof \Illuminate\Http\Client\RequestException) {
                return $exception->response->status() !== 429;
            }

            return true;
        })
            ->timeout((int) config('services.groq.matching_timeout', 20))
            ->connectTimeout(10)
            ->withToken($apiKey)
            ->acceptJson()
            ->post((string) config('services.groq.endpoint', 'https://api.groq.com/openai/v1/chat/completions'), [
                'model' => (string) config('services.groq.model', 'llama-3.1-8b-instant'),
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => $prompt,
                    ],
                ],
                'response_format' => [
                    'type' => 'json_object',
                ],
            ]);

        if ($response->status() === 429) {
            Log::warning('Groq Rate Limit Hit; fallback Hugging Face active.');

            return null;
        }

        if (! $response->successful()) {
            Log::warning('Groq semantic matching error response', [
                'status' => $response->status(),
                'body' => $this->limitText($response->body(), 500),
            ]);

            return null;
        }

        return $response->json('choices.0.message.content')
            ?? $response->json('choices.0.text')
            ?? $response->body();
    }

    private function callHuggingFace(string $prompt): ?string
    {
        $apiKey = $this->sanitizeApiKey((string) config('services.huggingface.api_key'), 'Hugging Face');
        if ($apiKey === '') {
            return null;
        }

        Log::info('Appel API Hugging Face lance');

        $response = Http::retry(1, 2000)
            ->timeout((int) config('services.huggingface.matching_timeout', 30))
            ->connectTimeout(10)
            ->withToken($apiKey)
            ->acceptJson()
            ->post((string) config('services.huggingface.endpoint'), [
                'inputs' => "[INST]\n{$prompt}\n[/INST]",
                'parameters' => [
                    'max_new_tokens' => 500,
                    'temperature' => 0.1,
                    'return_full_text' => false,
                ],
                'options' => [
                    'wait_for_model' => true,
                ],
            ]);

        if (! $response->successful()) {
            Log::warning('Hugging Face semantic matching error response', [
                'status' => $response->status(),
                'body' => $this->limitText($response->body(), 500),
            ]);

            return null;
        }

        return $response->json('0.generated_text')
            ?? $response->json('generated_text')
            ?? $response->body();
    }

    private function parseAiContent(string $content, string $provider): ?array
    {
        if (trim($content) === '') {
            Log::info($provider . ' semantic matching returned empty content.');

            return null;
        }

        Log::info($provider . ' RAW Response: ' . $content);

        $clean = $this->extractJsonPayload($content);
        Log::info('Contenu nettoye de ' . $provider . ': ' . $clean);

        $decoded = json_decode($clean, true);
        if (! is_array($decoded)) {
            Log::info($provider . ' semantic matching returned invalid JSON after cleaning', [
                'clean' => $this->limitText($clean, 500),
            ]);

            return null;
        }

        $candidate = $this->firstResultObject($decoded);
        if ($candidate === null) {
            return null;
        }

        return $this->normalizeAiResult($candidate);
    }

    private function extractJsonPayload(string $content): string
    {
        $clean = trim($content);
        $clean = preg_replace('/^\s*```(?:json)?\s*\n?/i', '', $clean);
        $clean = preg_replace('/\n?\s*```\s*$/', '', (string) $clean);
        $clean = trim((string) $clean);

        $arrayStart = strpos($clean, '[');
        $arrayEnd = strrpos($clean, ']');
        $objectStart = strpos($clean, '{');
        $objectEnd = strrpos($clean, '}');

        if ($arrayStart !== false && $arrayEnd !== false && $arrayEnd > $arrayStart) {
            return substr($clean, $arrayStart, $arrayEnd - $arrayStart + 1);
        }

        if ($objectStart !== false && $objectEnd !== false && $objectEnd > $objectStart) {
            return substr($clean, $objectStart, $objectEnd - $objectStart + 1);
        }

        return $clean;
    }

    private function firstResultObject(array $decoded): ?array
    {
        foreach (['resultats', 'results', 'offres', 'data'] as $key) {
            if (isset($decoded[$key]) && is_array($decoded[$key])) {
                return $this->firstResultObject($decoded[$key]);
            }
        }

        if (isset($decoded['score_offre']) || isset($decoded['score_entreprise']) || isset($decoded['score'])) {
            return $decoded;
        }

        foreach ($decoded as $item) {
            if (! is_array($item) || $item === []) {
                continue;
            }

            $candidate = $this->firstResultObject($item);
            if ($candidate !== null) {
                return $candidate;
            }
        }

        return null;
    }

    private function normalizeAiResult(array $decoded): array
    {
        $justification = $decoded['justification'] ?? $decoded['explanation'] ?? $decoded['commentaire'] ?? $decoded['comment'] ?? '';
        if (is_array($justification)) {
            $justification = implode(' ', array_map(fn ($line) => trim((string) $line), $justification));
        }

        return [
            'score_offre' => $this->clampScore($decoded['score_offre'] ?? $decoded['score'] ?? 0),
            'score_entreprise' => $this->clampScore($decoded['score_entreprise'] ?? $decoded['score'] ?? 0),
            'justification' => $this->limitText((string) $justification, 500),
        ];
    }

    private function mockAiResult(): array
    {
        return [
            'score_offre' => 0.0,
            'score_entreprise' => 0.0,
            'justification' => 'Analyse IA temporairement indisponible. Aucun score fiable ne peut etre calcule pour le moment.',
        ];
    }

    private function sanitizeApiKey(string $rawApiKey, string $provider): string
    {
        $apiKey = preg_replace('/\s+/', '', trim($rawApiKey));

        if ($rawApiKey !== $apiKey) {
            Log::warning($provider . ' API key contained whitespace characters and was sanitized.');
        }

        return (string) $apiKey;
    }

    private function joinNames(array $names): string
    {
        $names = array_values(array_filter(array_unique(array_map(
            fn ($name) => trim((string) $name),
            $names
        ))));

        return $names === [] ? 'Non renseigne' : implode(', ', $names);
    }

    private function clampScore(mixed $score): float
    {
        return max(0.0, min(100.0, round((float) $score, 1)));
    }

    private function limitText(string $text, int $maxLength): string
    {
        $text = trim($text);

        if (mb_strlen($text) <= $maxLength) {
            return $text;
        }

        return mb_substr($text, 0, $maxLength - 3) . '...';
    }

    public function getSuggestedStudentsForRecruiter(Recruteur $recruteur): array
    {
        $this->ensureAiMatchingConfigured();
        $targetNames = $this->getRecruiterTargetSkillNames($recruteur);
        $targetText = $this->buildRecruiterTargetText($recruteur, $targetNames);
        $minAiScore = (float) config('services.groq.matching_min_score', 15);

        $candidats = Candidat::query()
            ->select([
                'candidats.id',
                'candidats.specialite',
                'candidats.linkedin',
                'candidats.portfolio_public',
            ])
            ->with([
                'user:id,name,email,photo',
                'competences' => fn ($q) => $q->select('competences.id', 'competences.nom'),
                'projets' => fn ($q) => $q
                    ->select('projets.id', 'projets.candidat_id', 'projets.titre', 'projets.description')
                    ->with(['competences' => fn ($sq) => $sq->select('competences.id', 'competences.nom')]),
            ])
            ->withCount(['competences', 'projets'])
            ->where('portfolio_public', true)
            ->get();

        $out = [];
        foreach ($candidats as $candidat) {
            $union = $this->getStudentSkillNamesUnion($candidat);
            $matching = $this->getExactSkillOverlap($union, $targetNames);
            sort($matching);
            $matchCount = count($matching);
            $ai = $this->analyzeSemanticMatch($this->buildStudentProfileText($candidat), $targetText, 'entreprise', $candidat->id ?? null, $recruteur->id ?? null);
            $score = round((float) $ai['score_entreprise'], 1);

            if ($score < $minAiScore) {
                continue;
            }

            $user = $candidat->user;
            $top3 = $candidat->competences->take(3)->map(fn ($c) => ['id' => $c->id, 'nom' => $c->nom])->values()->all();

            $photoUrl = null;
            if ($user && $user->photo) {
                try {
                    $photoUrl = url(Storage::disk('public')->url($user->photo));
                } catch (\Throwable) {
                }
            }

            $out[] = [
                'id' => $candidat->id,
                'name' => $user?->name ?? 'Étudiant',
                'email' => $user?->email,
                'photo_url' => $photoUrl,
                'linkedin' => $candidat->linkedin,
                'specialite' => $candidat->specialite,
                'top_3_competences' => $top3,
                'competence_names' => array_values($union),
                'match_score' => $score,
                'match_count' => $matchCount,
                'matching_competences' => $matching,
                'score_offre' => round((float) $ai['score_offre'], 1),
                'score_entreprise' => $score,
                'justification' => $ai['justification'],
                'competences_count' => $candidat->competences_count ?? $candidat->competences->count(),
                'projets_count' => $candidat->projets_count ?? 0,
                'source' => 'ai_semantic_matching',
            ];
        }

        usort($out, function (array $a, array $b): int {
            if ($a['match_score'] !== $b['match_score']) {
                return $b['match_score'] <=> $a['match_score'];
            }

            return $b['match_count'] <=> $a['match_count'];
        });

        return $out;
    }

    /**
     * Étudiants (portfolio public) ayant au moins une compétence requise par l'offre (profil ou projets).
     * Score = (nombre de compétences offre présentes chez l'étudiant / nombre de compétences requises) × 100.
     *
     * @return list<array<string, mixed>>
     */
    public function getMatchingStudentsForOffer(Offre $offer): array
    {
        $offer->loadMissing(['competences:id,nom', 'recruteur.company', 'recruteur.competences', 'recruteur.offres.competences']);

        $requiredCompetences = $offer->competences;
        $requiredCompetenceIds = $requiredCompetences->pluck('id')->all();
        $requiredCount = count($requiredCompetenceIds);

        $candidats = Candidat::query()
            ->select([
                'candidats.id',
                'candidats.specialite',
                'candidats.linkedin',
                'candidats.portfolio_public',
            ])
            ->with([
                'user:id,name,email,photo',
                'competences' => fn ($q) => $q->select('competences.id', 'competences.nom'),
                'projets' => fn ($q) => $q
                    ->select('projets.id', 'projets.candidat_id', 'projets.titre', 'projets.description')
                    ->with(['competences' => fn ($sq) => $sq->select('competences.id', 'competences.nom')]),
            ])
            ->where('portfolio_public', true)
            ->get();

        $out = [];
        $requiredMap = $requiredCompetences->keyBy('id');

        foreach ($candidats as $candidat) {
            $studentCompetenceIds = $candidat->competences->pluck('id')
                ->merge(
                    $candidat->projets->flatMap(fn ($project) => $project->competences->pluck('id'))
                )
                ->unique()
                ->values()
                ->all();

            $commonCompetenceIds = array_intersect($studentCompetenceIds, $requiredCompetenceIds);
            $commonCount = count($commonCompetenceIds);
            $score = $requiredCount > 0 ? round(($commonCount / $requiredCount) * 100, 2) : 0.0;

            if ($commonCount === 0) {
                continue;
            }

            $matchingCompetences = array_values(array_map(function ($id) use ($requiredMap) {
                return [
                    'id' => $id,
                    'nom' => $requiredMap[$id]->nom ?? null,
                ];
            }, $commonCompetenceIds));

            $user = $candidat->user;
            $photoUrl = null;
            if ($user && $user->photo) {
                try {
                    $photoUrl = url(Storage::disk('public')->url($user->photo));
                } catch (\Throwable) {
                }
            }

            // Construire une justification détaillée pour le mapping étudiant <- offre
            $competencesOffreNoms = $requiredCompetences->pluck('nom')->all();
            $competencesCandidatNoms = array_values(array_filter(array_map(fn ($m) => $m['nom'] ?? null, $matchingCompetences)));
            $competencesManquantesNoms = array_values(array_diff($competencesOffreNoms, $competencesCandidatNoms));

            $textJustification = "Analyse d'adéquation Étudiant/Offre : " . $score . "% de concordance. ";
            if (!empty($competencesCandidatNoms)) {
                $textJustification .= "Le candidat maîtrise les compétences suivantes attendues par l'offre : [" . implode(', ', $competencesCandidatNoms) . "]. ";
            } else {
                $textJustification .= "Aucune des compétences requises par l'offre n'est présente dans le profil déclaré du candidat. ";
            }

            if (count($competencesManquantesNoms) > 0) {
                $textJustification .= "Pour améliorer l'adéquation, il est recommandé de renforcer le portfolio sur : [" . implode(', ', $competencesManquantesNoms) . "].";
            } else {
                $textJustification .= "Félicitations : le profil couvre 100% des compétences requises par cette offre.";
            }

            $out[] = [
                'candidat_id' => $candidat->id,
                'name' => $user?->name ?? 'Étudiant',
                'email' => $user?->email,
                'photo_url' => $photoUrl,
                'specialite' => $candidat->specialite,
                'linkedin' => $candidat->linkedin,
                'match_score_percent' => $score,
                'match_count' => $matchCount,
                'required_competences_count' => $requiredCount,
                'matching_competences' => $matchingCompetences,
                'score_offre' => $score,
                'score_entreprise' => $score,
                'justification' => $this->limitText((string) $textJustification, 1000),
                'source' => 'simple_matching',
            ];
        }

        usort($out, function (array $a, array $b): int {
            if ($a['match_score_percent'] !== $b['match_score_percent']) {
                return $b['match_score_percent'] <=> $a['match_score_percent'];
            }

            return $b['match_count'] <=> $a['match_count'];
        });

        return $out;
    }
}
