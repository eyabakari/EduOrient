<?php

use App\Models\Conversation;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('conversation.{conversationId}', function ($user, string $conversationId) {
    $conversation = Conversation::query()->find($conversationId);
    if (! $conversation) {
        return false;
    }

    return $conversation->involvesUser($user);
});
