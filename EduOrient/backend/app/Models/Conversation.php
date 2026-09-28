<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Conversation extends Model
{
    protected $fillable = [
        'candidat_id',
        'recruteur_id',
        'last_message_at',
    ];

    protected function casts(): array
    {
        return [
            'last_message_at' => 'datetime',
        ];
    }

    /**
     * @return BelongsTo<Candidat, Conversation>
     */
    public function candidat(): BelongsTo
    {
        return $this->belongsTo(Candidat::class);
    }

    /**
     * @return BelongsTo<Recruteur, Conversation>
     */
    public function recruteur(): BelongsTo
    {
        return $this->belongsTo(Recruteur::class);
    }

    /**
     * @return HasMany<Message, Conversation>
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    /**
     * @return HasOne<Message, Conversation>
     */
    public function latestMessage(): HasOne
    {
        return $this->hasOne(Message::class)->latestOfMany();
    }

    public function involvesUser(User $user): bool
    {
        if ($user->isCandidatRole() && $user->candidat && (int) $this->candidat_id === (int) $user->candidat->id) {
            return true;
        }

        if ($user->isRecruteur() && $user->recruteur && (int) $this->recruteur_id === (int) $user->recruteur->id) {
            return true;
        }

        return false;
    }
}

