<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Réinitialise les mots de passe des utilisateurs de test à "password".
 * Utilise une mise à jour SQL directe (un seul hash) pour éviter tout problème de cast.
 */
class ResetTestPasswords extends Command
{
    protected $signature = 'test:reset-passwords';

    protected $description = 'Réinitialise les mots de passe des utilisateurs de test à "password"';

    public function handle(): int
    {
        $emails = [
            'admin@prolink.tn',
            'sarra.mansour@prolink.tn',
            'mohamed.trabelsi@prolink.tn',
            'yassine.dridi@prolink.tn',
            'amel.majri@prolink.tn',
            'ines.chaabane@prolink.tn',
            'recrutement@instadeep.com',
            'rh@vermeg.com',
            'talent@sagemcom.com',
            'carrieres@sofrecom.com',
            'contact@talys.tn',
        ];

        $hashedPassword = Hash::make('password');

        foreach ($emails as $email) {
            $updated = DB::table('users')->where('email', $email)->update(['password' => $hashedPassword]);
            if ($updated) {
                $this->line("  <info>✓</info> {$email}");
            } else {
                $user = User::where('email', $email)->first();
                $this->line($user ? "  <comment>—</comment> {$email} (non mis à jour)" : "  <comment>—</comment> {$email} (non trouvé, exécutez: php artisan db:seed)");
            }
        }

        $this->info('Mots de passe réinitialisés. Connexion : email ci-dessus + mot de passe "password".');

        return self::SUCCESS;
    }
}
