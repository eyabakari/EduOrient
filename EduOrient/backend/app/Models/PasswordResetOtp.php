<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * OTP de réinitialisation de mot de passe (une ligne active par adresse e-mail).
 *
 * @property string $email
 * @property string $code hash du code à 6 chiffres
 * @property \Illuminate\Support\Carbon $expires_at
 */
class PasswordResetOtp extends Model
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

