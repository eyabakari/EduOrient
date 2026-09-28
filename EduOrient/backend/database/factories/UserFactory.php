<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    private static int $emailSequence = 0;

    public function definition(): array
    {
        $prenoms = [
            'Mohamed', 'Amine', 'Sami', 'Leila', 'Sarra', 'Yassine', 'Hamza', 'Meriem',
        ];
        $noms = [
            'Trabelsi', 'Ben Ammar', 'Jlassi', 'Guediri', 'Bouazizi', 'Mansour', 'Dridi',
        ];

        $name = fake()->randomElement($prenoms).' '.fake()->randomElement($noms);

        return [
            'role' => Role::NAME_CANDIDAT,
            'name' => $name,
            'email' => $this->nextTunisianEmail($name),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'preferences' => null,
        ];
    }

    public function candidat(): static
    {
        return $this->state(fn () => ['role' => Role::NAME_CANDIDAT]);
    }

    public function recruteur(): static
    {
        return $this->state(fn () => ['role' => Role::NAME_RECRUTEUR]);
    }

    public function unverified(): static
    {
        return $this->state(fn () => ['email_verified_at' => null]);
    }

    private function nextTunisianEmail(string $displayName): string
    {
        $parts = preg_split('/\s+/', trim($displayName), 2);
        $prenom = $parts[0] ?? 'etudiant';
        $nom = $parts[1] ?? 'tunisie';
        $slug = Str::slug(Str::ascii($prenom.'.'.$nom), '.');
        $slug = $slug !== '' ? $slug : 'user.'.Str::lower(Str::random(5));
        self::$emailSequence++;

        return Str::lower($slug.'.'.self::$emailSequence.'@gmail.com');
    }
}
