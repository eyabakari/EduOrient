<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;

/**
 * Politique d'autorisation pour le modèle Project.
 * Seul l'étudiant propriétaire du projet peut le modifier ou le supprimer.
 */
class ProjectPolicy
{
    /**
     * Détermine si l'utilisateur peut lister des projets (ses propres projets).
     */
    public function viewAny(User $user): bool
    {
        return $user->candidat !== null;
    }

    /**
     * Détermine si l'utilisateur peut consulter le projet (propriétaire uniquement).
     */
    public function view(User $user, Project $project): bool
    {
        return $user->candidat && $user->candidat->id === $project->candidat_id;
    }

    /**
     * Détermine si l'utilisateur peut créer un projet (étudiants uniquement).
     */
    public function create(User $user): bool
    {
        return $user->candidat !== null;
    }

    /**
     * Détermine si l'utilisateur peut modifier le projet (propriétaire uniquement).
     */
    public function update(User $user, Project $project): bool
    {
        return $user->candidat && $user->candidat->id === $project->candidat_id;
    }

    /**
     * Détermine si l'utilisateur peut supprimer le projet (propriétaire uniquement).
     */
    public function delete(User $user, Project $project): bool
    {
        return $user->candidat && $user->candidat->id === $project->candidat_id;
    }
}

