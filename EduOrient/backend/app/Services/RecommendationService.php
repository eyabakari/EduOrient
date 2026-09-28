<?php

namespace App\Services;

use App\Models\Candidat;

/**
 * Moteur de recommandation strict et fondé sur les preuves :
 * - Compétences (60 %) : union compétences directes + compétences des projets vs compétences requises.
 * - Spécialité (30 %) : correspondance stricte par mots-clés avec les filières idéales.
 * - Bonus projet (10 %) : au moins un projet lié au parcours (compétences en commun).
 * Les recommandations avec score total < 15 % sont exclues.
 */
class RecommendationService
{
    private KnowledgeBaseParser $parser;

    private const WEIGHT_SKILLS = 0.6;

    private const WEIGHT_SPECIALITE = 0.3;

    private const WEIGHT_PROJECT_BONUS = 0.1;

    private const MIN_SCORE_THRESHOLD = 0.15;

    public function __construct(?KnowledgeBaseParser $parser = null)
    {
        $this->parser = $parser ?? new KnowledgeBaseParser;
    }

    /**
     * Retourne les recommandations (top 3) avec preuves : matching_skills, matching_projects.
     * Exclut les parcours dont le score total est inférieur à 15 %.
     *
     * @return array<int, array{name: string, score: float, matching_skills: array, matching_projects: array, missing_skills: array, suggested_certs: array, career_tip: string, target_companies: array, metier_final: string}>
     */
    public function getRecommendations(Candidat $candidat): array
    {
        $paths = $this->parser->getCareerPaths();
        $pathRequiredSkills = config('recommendation.path_required_skills', []);
        $certsByDomain = $this->parser->getCertificationsByDomain();

        $directSkillNames = $this->getDirectSkillNames($candidat);
        $projectsWithSkillNames = $this->getProjectsWithSkillNames($candidat);
        $unionSkillNames = array_values(array_unique(array_merge($directSkillNames, $projectsWithSkillNames['all_skill_names'])));
        $specialite = $this->getSpecialiteStrict($candidat);

        $hasNoSkillsAndNoProjects = count($directSkillNames) === 0 && count($projectsWithSkillNames['projects']) === 0;

        $scored = [];
        foreach ($paths as $path) {
            $name = $path['name'];
            $requiredNames = $pathRequiredSkills[$name] ?? [];

            $skillResult = $this->computeSkillScoreStrict($unionSkillNames, $requiredNames);
            $specialiteScore = $this->computeSpecialiteScoreStrict($specialite, $path['ideal_degrees'] ?? []);

            $matchingProjects = $this->getMatchingProjectsForPath($projectsWithSkillNames['projects'], $requiredNames);
            $projectBonus = count($matchingProjects) >= 1 ? 1.0 : 0.0;

            $total = self::WEIGHT_SKILLS * $skillResult['score']
                + self::WEIGHT_SPECIALITE * $specialiteScore
                + self::WEIGHT_PROJECT_BONUS * $projectBonus;

            // Si l'utilisateur n'a aucune compétence ni aucun projet, le score doit être 0 %
            if ($hasNoSkillsAndNoProjects) {
                $total = 0.0;
            }

            if ($total < self::MIN_SCORE_THRESHOLD) {
                continue;
            }

            $missing = array_values(array_diff($requiredNames, $skillResult['matching_skills']));
            $suggestedCerts = $this->suggestCertsForPath($name, $certsByDomain);
            $careerTip = $this->buildCareerTip($path, $total, $missing, $skillResult['matching_skills'], $matchingProjects);

            $scored[] = [
                'name' => $name,
                'score' => round($total * 100, 1),
                'matching_skills' => $skillResult['matching_skills'],
                'matching_projects' => $matchingProjects,
                'missing_skills' => $missing,
                'suggested_certs' => $suggestedCerts,
                'career_tip' => $careerTip,
                'target_companies' => $path['companies'] ?? [],
                'metier_final' => $path['metier_final'] ?? '',
                // --- ZID HEDHOM BECH EL FRONT-END Y-CHOUFHOM ---
                'recruteur_id' => $path['recruteur_id'] ?? null, 
                'contact_email' => $path['contact_email'] ?? 'rh@prolink.tn',
            ];
        }

        return collect($scored)
            ->sortByDesc('score')
            ->take(3)
            ->values()
            ->all();
    }

    /**
     * Compétences déclarées directement par l'étudiant (table etudiant_competence).
     */
    private function getDirectSkillNames(Candidat $candidat): array
    {
        return $candidat->skills()->pluck('nom')->all();
    }

    /**
     * Projets avec les noms de compétences de chaque projet + union de toutes les compétences projets.
     *
     * @return array{all_skill_names: array, projects: array<int, array{id: int, titre: string, skill_names: array}>}
     */
    private function getProjectsWithSkillNames(Candidat $candidat): array
    {
        $projects = $candidat->projects()->with('skills')->get();
        $allSkillNames = [];
        $projectList = [];

        foreach ($projects as $project) {
            $skillNames = $project->skills->pluck('nom')->all();
            $allSkillNames = array_merge($allSkillNames, $skillNames);
            $projectList[] = [
                'id' => $project->id,
                'titre' => $project->titre ?? 'Sans titre',
                'skill_names' => $skillNames,
            ];
        }

        return [
            'all_skill_names' => array_values(array_unique($allSkillNames)),
            'projects' => $projectList,
        ];
    }

    /**
     * Spécialité brute (null ou chaîne) pour correspondance stricte.
     */
    private function getSpecialiteStrict(Candidat $candidat): ?string
    {
        $s = $candidat->specialite;
        return $s === null || trim((string) $s) === '' ? null : trim((string) $s);
    }

    /**
     * Score compétences strict : 0 si aucune compétence requise ne matche, sinon proportion.
     * Retourne aussi les compétences qui ont matché.
     */
    private function computeSkillScoreStrict(array $userSkillNames, array $requiredNames): array
    {
        $matching = array_values(array_intersect($userSkillNames, $requiredNames));
        if ($requiredNames === []) {
            return ['score' => 1.0, 'matching_skills' => []];
        }
        if (count($matching) === 0) {
            return ['score' => 0.0, 'matching_skills' => []];
        }
        return [
            'score' => count($matching) / count($requiredNames),
            'matching_skills' => $matching,
        ];
    }

    /**
     * Score spécialité strict : 0 si specialite est null/vide ou ne matche aucun ideal_degree (mot-clé).
     */
    private function computeSpecialiteScoreStrict(?string $specialite, array $idealDegrees): float
    {
        if ($specialite === null || $specialite === '' || $idealDegrees === []) {
            return 0.0;
        }
        $lower = mb_strtolower($specialite);
        foreach ($idealDegrees as $ideal) {
            $ideal = trim((string) $ideal);
            if ($ideal === '') {
                continue;
            }
            if (mb_strpos($lower, mb_strtolower($ideal)) !== false) {
                return 1.0;
            }
            if (mb_strpos(mb_strtolower($ideal), $lower) !== false) {
                return 1.0;
            }
        }
        return 0.0;
    }

    /**
     * Projets dont au moins une compétence est dans les compétences requises du parcours.
     * Retourne une liste de tableaux { id, titre } pour le JSON.
     */
    private function getMatchingProjectsForPath(array $projectsWithSkillNames, array $requiredNames): array
    {
        if ($requiredNames === []) {
            return [];
        }
        $requiredSet = array_flip($requiredNames);
        $matching = [];
        foreach ($projectsWithSkillNames as $p) {
            foreach ($p['skill_names'] as $nom) {
                if (isset($requiredSet[$nom])) {
                    $matching[] = ['id' => $p['id'], 'titre' => $p['titre']];
                    break;
                }
            }
        }
        return $matching;
    }

    private function suggestCertsForPath(string $pathName, array $certsByDomain): array
    {
        $suggested = [];
        if (stripos($pathName, 'Logiciel') !== false || stripos($pathName, 'GL') !== false) {
            $suggested = array_merge(
                $suggested,
                $certsByDomain['Cloud'] ?? [],
                $certsByDomain['Développement'] ?? []
            );
        }
        if (stripos($pathName, 'Réseaux') !== false || stripos($pathName, 'Télécoms') !== false) {
            $suggested = array_merge($suggested, $certsByDomain['Cloud'] ?? [], $certsByDomain['Réseaux & Cyber'] ?? []);
        }
        if (stripos($pathName, 'IA') !== false || stripos($pathName, 'Intelligence') !== false || stripos($pathName, 'Data Science') !== false) {
            $suggested = array_merge($suggested, $certsByDomain['Data'] ?? []);
        }
        if (stripos($pathName, 'BI') !== false || stripos($pathName, 'Business Intelligence') !== false) {
            $suggested = array_merge($suggested, $certsByDomain['Data'] ?? []);
        }
        if (stripos($pathName, 'Cyber') !== false) {
            $suggested = array_merge($suggested, $certsByDomain['Réseaux & Cyber'] ?? []);
        }
        return array_values(array_unique(array_slice($suggested, 0, 5)));
    }

    private function buildCareerTip(array $path, float $score, array $missing, array $matchingSkills, array $matchingProjects): string
    {
        $metier = $path['metier_final'] ?? '';
        $evidence = [];
        if ($matchingSkills !== []) {
            $evidence[] = 'Compétences alignées : ' . implode(', ', $matchingSkills);
        }
        if ($matchingProjects !== []) {
            $titles = array_column($matchingProjects, 'titre');
            $evidence[] = 'Projets concernés : ' . implode(', ', $titles);
        }

        if ($score >= 0.8) {
            $base = sprintf('Votre profil correspond bien au parcours %s (métier cible : %s).', $path['name'], $metier ?: 'voir entreprises cibles');
            return $evidence !== [] ? $base . ' ' . implode('. ', $evidence) : $base;
        }
        if ($score >= 0.5) {
            $hint = $missing !== []
                ? 'À renforcer : ' . implode(', ', array_slice($missing, 0, 3)) . '.'
                : 'Consolidez votre expérience.';
            return sprintf('Parcours %s envisageable. %s ', $path['name'], $hint) . ($evidence !== [] ? implode('. ', $evidence) : '');
        }
        return sprintf(
            'Pour viser le parcours %s, travaillez les compétences demandées et rapprochez-vous des formations recommandées.',
            $path['name']
        );
    }
}
