<?php

namespace App\Policies;

use App\Models\Projet;
use App\Models\User;

/**
 * Politique d'autorisation pour le modèle Projet.
 * Seul l'étudiant propriétaire du projet peut le modifier ou le supprimer.
 */
class ProjetPolicy
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
    public function view(User $user, Projet $projet): bool
    {
        return $user->candidat && $user->candidat->id === $projet->candidat_id;
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
    public function update(User $user, Projet $projet): bool
    {
        return $user->candidat && $user->candidat->id === $projet->candidat_id;
    }

    /**
     * Détermine si l'utilisateur peut supprimer le projet (propriétaire uniquement).
     */
    public function delete(User $user, Projet $projet): bool
    {
        return $user->candidat && $user->candidat->id === $projet->candidat_id;
    }
}

