<?php

namespace App\Services;

use App\Models\AppSetting;
use Illuminate\Validation\Rules\Password;

class PasswordPolicy
{
    public const SIMPLE = 'simple';

    public const STANDARD = 'standard';

    public const STRICT = 'strict';

    /**
     * Retourne la règle de validation Laravel pour le mot de passe selon la politique configurée (admin).
     */
    public static function rule(): Password
    {
        $policy = AppSetting::getValue('password_policy', self::STANDARD);

        return match ($policy) {
            self::SIMPLE => Password::min(6),
            self::STRICT => Password::min(12)->letters()->mixedCase()->numbers()->symbols(),
            default => Password::min(8)->letters()->numbers(),
        };
    }

    /**
     * Description courte de la politique (pour messages d'erreur ou affichage).
     */
    public static function description(): string
    {
        $policy = AppSetting::getValue('password_policy', self::STANDARD);

        return match ($policy) {
            self::SIMPLE => '6 caractères minimum',
            self::STRICT => '12 caractères minimum, avec majuscules, minuscules, chiffres et symboles',
            default => '8 caractères minimum, avec lettres et chiffres',
        };
    }
}
