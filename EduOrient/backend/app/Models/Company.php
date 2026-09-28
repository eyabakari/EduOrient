<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Informations entreprise du compte recruteur (1:1 avec User).
 */
class Company extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'ville',
        'gouvernorat',
        'description',
    ];

    /**
     * @return BelongsTo<User, Company>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

