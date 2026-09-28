<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Offre extends Model
{
    /** @use HasFactory<\Database\Factories\OffreFactory> */
    use HasFactory;

    public const TYPE_STAGE = 'stage';

    public const TYPE_EMPLOI = 'emploi';

    protected $fillable = [
        'recruteur_id',
        'titre',
        'description',
        'type',
        'lieu',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    /**
     * @return BelongsTo<Recruteur, Offre>
     */
    public function recruteur(): BelongsTo
    {
        return $this->belongsTo(Recruteur::class, 'recruteur_id', 'id');
    }

    /**
     * @return BelongsToMany<Competence, Offre>
     */
    public function competences(): BelongsToMany
    {
        return $this->belongsToMany(Competence::class, 'offre_competence', 'offre_id', 'competence_id')->withTimestamps();
    }

    /**
     * @return BelongsToMany<Competence, Offre>
     */
    public function skills(): BelongsToMany
    {
        return $this->competences();
    }
}

