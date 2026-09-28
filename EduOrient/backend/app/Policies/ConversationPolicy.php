<?php

namespace App\Policies;

use App\Models\Conversation;
use App\Models\User;

class ConversationPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isEtudiant() || $user->isRecruteur();
    }

    public function view(User $user, Conversation $conversation): bool
    {
        return $conversation->involvesUser($user);
    }

    public function create(User $user): bool
    {
        return $user->isEtudiant() || $user->isRecruteur();
    }

    public function sendMessage(User $user, Conversation $conversation): bool
    {
        return $conversation->involvesUser($user);
    }
}

