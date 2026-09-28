<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Recruteur extends Model
{
    use HasFactory;

    protected $table = 'recruteurs';

    public $incrementing = false;

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'entreprise',
        'poste',
        'site_web',
        'ville',
        'gouvernorat',
        'description',
    ];

    /**
     * @return BelongsTo<User, Recruteur>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }

    /**
     * @return BelongsToMany<Competence, Recruteur>
     */
    public function competences(): BelongsToMany
    {
        return $this->belongsToMany(Competence::class, 'recruteur_competence', 'recruteur_id', 'competence_id')->withTimestamps();
    }

    /**
     * @return BelongsToMany<Competence, Recruteur>
     */
    public function skills(): BelongsToMany
    {
        return $this->competences();
    }

    /**
     * @return HasMany<Offre, Recruteur>
     */
    public function offres(): HasMany
    {
        return $this->hasMany(Offre::class, 'recruteur_id', 'id');
    }

    /**
     * @return HasMany<Conversation, Recruteur>
     */
    public function conversations(): HasMany
    {
        return $this->hasMany(Conversation::class, 'recruteur_id', 'id');
    }
}

