<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Message de contact envoyé depuis le footer (formulaire public).
 */
class Contact extends Model
{
    protected $fillable = [
        'email',
        'message',
        'status',
    ];
}

