<?php

namespace App\Services;

use App\Models\Competence;
use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * Service de gestion des projets du portfolio étudiant.
 * Création, mise à jour et suppression avec synchronisation des compétences (skill_ids et noms libres).
 */
class ProjectService
{
    /**
     * Résout les noms de compétences en IDs (création si nécessaire).
     *
     * @param  array<string>  $names
     * @return array<int>
     */
    private function resolveSkillIdsFromNames(array $names): array
    {
        $ids = [];
        foreach ($names as $name) {
            $name = trim($name);
            if ($name === '') {
                continue;
            }
            $skill = Competence::firstOrCreate(
                ['nom' => $name],
                ['categorie' => null]
            );
            $ids[] = $skill->id;
        }
        return array_unique($ids);
    }

    /**
     * Crée un projet et associe les compétences (skill_ids + skill_names libres) dans une transaction.
     *
     * @param  array{titre: string, description?: string, lien_github?: string, lien_demo?: string, date_debut?: string, date_fin?: string, skill_ids?: array<int>, skill_names?: array<string>}  $data
     * @return Project
     */
    public function createProject(array $data, int $etudiantId): Project
    {
        return DB::transaction(function () use ($data, $etudiantId) {
            $skillIds = $data['skill_ids'] ?? [];
            $skillNames = $data['skill_names'] ?? [];
            unset($data['skill_ids'], $data['skill_names']);

            $idsFromNames = $this->resolveSkillIdsFromNames($skillNames);
            $allIds = array_unique(array_merge($skillIds, $idsFromNames));

            $project = Project::create(array_merge($data, ['candidat_id' => $etudiantId]));

            if (! empty($allIds)) {
                $project->skills()->sync($allIds);

                // Keep the candidate skill profile in sync with the project.
                $this->syncSkillsToCandidat($etudiantId, $allIds);
            }

            return $this->loadProjectRelationsForApi($project);
        });
    }

    /**
     * Remplace la galerie par les fichiers uploadés (stockage disk public sous `projects/`).
     *
     * @param  list<UploadedFile>  $files
     */
    public function syncGalleryImages(Project $project, array $files): void
    {
        DB::transaction(function () use ($project, $files) {
            $project->load('projectImages');
            foreach ($project->projectImages as $img) {
                if ($img->image_path && Storage::disk('public')->exists($img->image_path)) {
                    Storage::disk('public')->delete($img->image_path);
                }
            }
            $project->projectImages()->delete();

            foreach ($files as $file) {
                if (! $file instanceof UploadedFile || ! $file->isValid()) {
                    continue;
                }
                $path = Storage::disk('public')->putFile('projects', $file);
                ProjectImage::query()->create([
                    'projet_id' => $project->id,
                    'image_path' => $path,
                ]);
            }
        });

        $project->load('projectImages');
    }

    /**
     * Met à jour un projet et synchronise les compétences (skill_ids) dans une transaction.
     *
     * @param  array{titre?: string, description?: string, lien_github?: string, lien_demo?: string, date_debut?: string, date_fin?: string, skill_ids?: array<int>}  $data
     * @return Project
     */
    public function updateProject(Project $project, array $data): Project
    {
        return DB::transaction(function () use ($project, $data) {
            $skillIds = $data['skill_ids'] ?? null;
            $skillNames = $data['skill_names'] ?? [];
            unset($data['skill_ids'], $data['skill_names']);

            $project->update(array_filter($data, fn ($v) => $v !== null));

            if (is_array($skillIds) || ! empty($skillNames)) {
                $idsFromNames = $this->resolveSkillIdsFromNames($skillNames);
                $allIds = array_unique(array_merge($skillIds ?? [], $idsFromNames));
                $project->skills()->sync($allIds);

                // --- Keep the candidate skill profile in sync with the project.
                $this->syncSkillsToCandidat($project->candidat_id, $allIds);
            }

            return $this->loadProjectRelationsForApi($project);
        });
    }

    /**
     * Supprime un projet (pivot projet_competence en cascade côté BDD).
     * Les fichiers disque (image principale + galerie project_images) sont retirés dans
     * {@see Project::booted()} (événement `deleting`).
     */
    public function deleteProject(Project $project): bool
    {
        return $project->delete();
    }

    /**
     * @return Project
     */
    public function loadProjectRelationsForApi(Project $project): Project
    {
        return $project->load([
            'skills' => fn ($q) => $q->select('competences.id', 'competences.nom', 'competences.nom', 'competences.categorie', 'competences.categorie'),
            'projectImages' => fn ($q) => $q->select('projet_images.id', 'projet_images.projet_id', 'projet_images.image_path'),
        ]);
    }
    /**
     * Synchronise les compétences du projet avec le profil global du candidat.
     */
    private function syncSkillsToCandidat(int $candidatId, array $skillIds): void
    {
        if (empty($skillIds)) return;

        $candidat = \App\Models\Candidat::find($candidatId);
        if ($candidat) {
            // syncWithoutDetaching adds new skills without removing existing ones.
            $candidat->skills()->syncWithoutDetaching($skillIds);
        }
    }
}
