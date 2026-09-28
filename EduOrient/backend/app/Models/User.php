<?php

namespace App\Models;

use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmailContract
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, MustVerifyEmail, Notifiable;

    protected $fillable = [
        'role',
        'name',
        'email',
        'password',
        'photo',
        'preferences',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = ['photo_url'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'preferences' => 'array',
        ];
    }

    protected function photoUrl(): Attribute
    {
        return Attribute::get(fn () => $this->photo
            ? url(Storage::disk('public')->url($this->photo))
            : null);
    }

    /**
     * @return HasOne<Candidat, User>
     */
    public function candidat(): HasOne
    {
        return $this->hasOne(Candidat::class, 'id', 'id');
    }

    /**
     * @return HasOne<Candidat, User>
     */
    public function etudiant(): HasOne
    {
        return $this->candidat();
    }

    /**
     * @return HasOne<Recruteur, User>
     */
    public function recruteur(): HasOne
    {
        return $this->hasOne(Recruteur::class, 'id', 'id');
    }

    public function isAdmin(): bool
    {
        return $this->role === Role::NAME_ADMIN;
    }

    public function isCandidatRole(): bool
    {
        return $this->role === Role::NAME_CANDIDAT || $this->role === Role::NAME_ETUDIANT;
    }

    public function isEtudiant(): bool
    {
        return $this->isCandidatRole();
    }

    public function isRecruteur(): bool
    {
        return $this->role === Role::NAME_RECRUTEUR;
    }

    public function sendEmailVerificationNotification(): void
    {
        app(\App\Services\EmailVerificationOtpService::class)->issueAndSend($this);
    }

    /**
     * Format API compatible mobile (role.name + role_id legacy).
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $array = parent::toArray();
        $roleName = $this->attributes['role'] ?? null;
        $array['role'] = $roleName ? ['name' => $roleName] : null;
        $array['role_id'] = match ($roleName) {
            Role::NAME_CANDIDAT => 2,
            Role::NAME_RECRUTEUR => 3,
            default => null,
        };

        return $array;
    }
}

