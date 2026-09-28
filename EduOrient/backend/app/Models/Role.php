<?php

namespace App\Models;

/**
 * Constantes de rôles (plus de table roles — colonne users.role).
 */
class Role
{
    public const NAME_ADMIN = 'admin';

    public const NAME_ETUDIANT = 'etudiant';

    public const NAME_CANDIDAT = 'candidat';

    public const NAME_RECRUTEUR = 'recruteur';

    /** role_id mobile / legacy : 2 = candidat, 3 = recruteur */
    public static function fromLegacyRoleId(int $roleId): ?string
    {
        return match ($roleId) {
            2 => self::NAME_CANDIDAT,
            3 => self::NAME_RECRUTEUR,
            default => null,
        };
    }
}

