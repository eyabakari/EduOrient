<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

/**
 * Seeder : enregistre les rôles par défaut (admin, candidat, recruteur).
 * À exécuter après les migrations pour que les utilisateurs puissent être créés.
 */
class RoleSeeder extends Seeder
{
    /**
     * Exécute le seed.
     */
    public function run(): void
    {
        $roles = [
            ['name' => Role::NAME_ADMIN],
            ['name' => Role::NAME_candidat],
            ['name' => Role::NAME_RECRUTEUR],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(
                ['name' => $role['name']],
                $role
            );
        }
    }
}

