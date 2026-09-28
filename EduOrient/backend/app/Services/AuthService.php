<?php

namespace App\Services;

use App\Models\Candidat;
use App\Models\Recruteur;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class AuthService
{
    /**
     * @param  array{role?: string, role_id?: int, name: string, email: string, password: string, ...}  $data
     */
    public function register(array $data, ?UploadedFile $photo = null): User
    {
        return DB::transaction(function () use ($data, $photo) {
            $role = $data['role'] ?? Role::fromLegacyRoleId((int) ($data['role_id'] ?? 0));
            if (! $role) {
                throw ValidationException::withMessages([
                    'role_id' => [__('Le rôle sélectionné n\'est pas valide.')],
                ]);
            }

            $photoPath = null;
            if ($photo && $photo->isValid()) {
                $photoPath = Storage::disk('public')->putFile('profile-photos', $photo);
            }

            $user = User::create([
                'role' => $role,
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'photo' => $photoPath,
                'email_verified_at' => null,
            ]);

            if ($role === Role::NAME_CANDIDAT) {
                Candidat::create([
                    'id' => $user->id,
                    'bio' => $data['bio'] ?? null,
                    'niveau_etude' => $data['niveau_etude'] ?? null,
                    'specialite' => $data['specialite'] ?? null,
                    'linkedin' => $data['linkedin'] ?? null,
                ]);
            }

            if ($role === Role::NAME_RECRUTEUR) {
                $recruteur = Recruteur::create([
                    'id' => $user->id,
                    'entreprise' => $data['entreprise'] ?? null,
                    'poste' => $data['poste'] ?? 'Recruteur',
                    'site_web' => $data['site_web'] ?? null,
                    'ville' => $data['ville'] ?? null,
                    'gouvernorat' => $data['gouvernorat'] ?? null,
                    'description' => $data['company_description'] ?? ('Entreprise '.$data['entreprise'].' inscrite sur EduOrient.'),
                ]);

                if (! empty($data['skill_ids']) && is_array($data['skill_ids'])) {
                    $recruteur->competences()->sync($data['skill_ids']);
                }
            }

            return $user->load(['candidat', 'recruteur', 'recruteur.competences']);
        });
    }

    /**
     * @param  array{email: string, password: string, device_name?: string}  $credentials
     * @return array{user: User, token: string}
     */
    public function login(array $credentials): array
    {
        $user = User::where('email', $credentials['email'])->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => [__('Les identifiants fournis sont incorrects.')],
            ]);
        }

        $deviceName = $credentials['device_name'] ?? 'api-client';
        $token = $user->createToken($deviceName)->plainTextToken;

        $user->load(['candidat', 'recruteur', 'recruteur.competences']);

        return [
            'user' => $user,
            'token' => $token,
        ];
    }
}
