<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Compétence ou langue (categorie = Backend | Frontend | ...).
 */
class Competence extends Model
{
    use HasFactory;

    public const CATEGORIE_LANGUE = 'Langue';

    protected $table = 'competences';

    protected $fillable = [
        'nom',
        'categorie',
    ];

    protected $appends = ['name', 'category'];

    /**
     * Accesseur pour le nom
     */
    protected function name(): Attribute
    {
        return Attribute::get(fn () => $this->nom);
    }

    /**
     * Accesseur pour la catégorie
     */
    protected function category(): Attribute
    {
        return Attribute::get(fn () => $this->formattedCategory());
    }

    private function formattedCategory(): ?string
    {
        $raw = trim((string) $this->categorie);
        return $raw !== '' ? $raw : null;
    }

    /**
     * Vérifie si c'est une catégorie de langue
     */
    public static function isLanguageCategory(?string $category): bool
    {
        $value = mb_strtolower(trim((string) $category));
        return in_array($value, ['langue', 'language'], true);
    }

    /**
     * @return BelongsToMany<Projet, Competence>
     */
    public function projets(): BelongsToMany
    {
        return $this->belongsToMany(Projet::class, 'projet_competence', 'competence_id', 'projet_id')->withTimestamps();
    }

    /**
     * @return BelongsToMany<Projet, Competence>
     */
    public function projects(): BelongsToMany
    {
        return $this->projets();
    }

    /**
     * @return BelongsToMany<Candidat, Competence>
     */
    public function candidats(): BelongsToMany
    {
        return $this->belongsToMany(Candidat::class, 'candidat_competence', 'competence_id', 'candidat_id')
            ->withPivot('level')
            ->withTimestamps();
    }

    /**
     * @return BelongsToMany<Offre, Competence>
     */
    public function offres(): BelongsToMany
    {
        return $this->belongsToMany(Offre::class, 'offre_competence', 'competence_id', 'offre_id')->withTimestamps();
    }

    /**
     * @return BelongsToMany<Recruteur, Competence>
     */
    public function recruteurs(): BelongsToMany
    {
        return $this->belongsToMany(Recruteur::class, 'recruteur_competence', 'competence_id', 'recruteur_id')->withTimestamps();
    }
}

