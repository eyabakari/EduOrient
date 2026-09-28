<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class ProjetImage extends Model
{
    protected $table = 'projet_images';

    protected $fillable = [
        'projet_id',
        'image_path',
    ];

    protected $appends = ['url'];

    /**
     * @return BelongsTo<Projet, ProjetImage>
     */
    public function projet(): BelongsTo
    {
        return $this->belongsTo(Projet::class, 'projet_id');
    }

    /**
     * @return BelongsTo<Projet, ProjetImage>
     */
    public function project(): BelongsTo
    {
        return $this->projet();
    }

    protected function url(): Attribute
    {
        return Attribute::get(fn () => $this->image_path
            ? Storage::disk('public')->url($this->image_path)
            : null);
    }
}

