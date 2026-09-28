<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Candidat extends Model
{
    use HasFactory;

    protected $table = 'candidats';

    public $incrementing = false;

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'bio',
        'niveau_etude',
        'specialite',
        'linkedin',
        'portfolio_public',
    ];

    protected function casts(): array
    {
        return [
            'portfolio_public' => 'boolean',
        ];
    }

    /**
     * @return BelongsTo<User, Candidat>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }

    /**
     * @return HasMany<Projet, Candidat>
     */
    public function projets(): HasMany
    {
        return $this->hasMany(Projet::class, 'candidat_id', 'id');
    }

    /**
     * @return HasMany<Projet, Candidat>
     */
    public function projects(): HasMany
    {
        return $this->projets();
    }

    /**
     * @return BelongsToMany<Competence, Candidat>
     */
    public function competences(): BelongsToMany
    {
        return $this->belongsToMany(Competence::class, 'candidat_competence', 'candidat_id', 'competence_id')
            ->withPivot('level')
            ->withTimestamps();
    }

    /**
     * @return BelongsToMany<Competence, Candidat>
     */
    public function skills(): BelongsToMany
    {
        return $this->competences();
    }

    /**
     * @return HasMany<Conversation, Candidat>
     */
    public function conversations(): HasMany
    {
        return $this->hasMany(Conversation::class, 'candidat_id', 'id');
    }
}

