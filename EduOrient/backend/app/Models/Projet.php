<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Projet extends Model
{
    use HasFactory;

    protected $table = 'projets';

    protected $hidden = ['projetImages'];

    protected $appends = ['image_url', 'gallery'];

    protected static function booted(): void
    {
        static::deleting(function (Projet $projet): void {
            $projet->loadMissing('projetImages');
            foreach ($projet->projetImages as $img) {
                if ($img->image_path && Storage::disk('public')->exists($img->image_path)) {
                    Storage::disk('public')->delete($img->image_path);
                }
            }
            if ($projet->image && Storage::disk('public')->exists($projet->image)) {
                Storage::disk('public')->delete($projet->image);
            }
        });
    }

    protected $fillable = [
        'candidat_id',
        'titre',
        'description',
        'lien_github',
        'lien_demo',
        'image',
        'date_debut',
        'date_fin',
    ];

    protected function casts(): array
    {
        return [
            'date_debut' => 'date',
            'date_fin' => 'date',
        ];
    }

    /**
     * @return BelongsTo<Candidat, Projet>
     */
    public function candidat(): BelongsTo
    {
        return $this->belongsTo(Candidat::class, 'candidat_id', 'id');
    }

    /**
     * @return BelongsToMany<Competence, Projet>
     */
    public function competences(): BelongsToMany
    {
        return $this->belongsToMany(Competence::class, 'projet_competence', 'projet_id', 'competence_id')->withTimestamps();
    }

    /**
     * Alias API legacy.
     *
     * @return BelongsToMany<Competence, Projet>
     */
    public function skills(): BelongsToMany
    {
        return $this->competences();
    }

    /**
     * @return HasMany<ProjetImage, Projet>
     */
    public function projetImages(): HasMany
    {
        return $this->hasMany(ProjetImage::class, 'projet_id')->orderBy('id');
    }

    /**
     * @return HasMany<ProjetImage, Projet>
     */
    public function projectImages(): HasMany
    {
        return $this->projetImages();
    }

    protected function imageUrl(): Attribute
    {
        return Attribute::get(fn () => $this->image
            ? Storage::disk('public')->url($this->image)
            : null);
    }

    protected function gallery(): Attribute
    {
        return Attribute::get(function () {
            $this->loadMissing('projetImages');

            return $this->projetImages->map(fn (ProjetImage $img) => [
                'id' => $img->id,
                'url' => $img->url,
            ])->values()->all();
        });
    }
}

