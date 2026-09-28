<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * OTP e-mail d’inscription (une ligne active par adresse).
 *
 * @property string $email
 * @property string $code hash du code à 6 chiffres
 * @property \Illuminate\Support\Carbon $expires_at
 */
class EmailVerification extends Model
{
    protected $fillable = [
        'email',
        'code',
        'expires_at',
    ];

    protected function casts(): array
    {
        return [
            'expires_at' => 'datetime',
        ];
    }
}

