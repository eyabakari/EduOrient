<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model
{
    protected $table = 'app_settings';

    protected $fillable = ['key', 'value'];

    /**
     * Récupère une valeur par clé.
     */
    public static function getValue(string $key, mixed $default = null): mixed
    {
        $row = static::where('key', $key)->first();

        return $row !== null ? $row->value : $default;
    }

    /**
     * Enregistre une valeur pour une clé.
     */
    public static function setValue(string $key, mixed $value): void
    {
        static::updateOrCreate(
            ['key' => $key],
            ['value' => is_string($value) ? $value : json_encode($value)]
        );
    }
}

