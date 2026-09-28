<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdateSettingsRequest;
use App\Models\AppSetting;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Met à jour le profil de l'utilisateur connecté (nom, photo, et profil rôle).
     */
    public function update(UpdateProfileRequest $request): JsonResponse
    {
        $user = $request->user();
        $data = $request->validated();

        if (isset($data['name'])) {
            $user->update(['name' => $data['name']]);
        }

        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }
            $user->update(['photo' => Storage::disk('public')->putFile('profile-photos', $request->file('photo'))]);
        }

        $candidatKeys = ['bio', 'niveau_etude', 'specialite', 'linkedin', 'portfolio_public'];
        if ($user->candidat && array_intersect_key($data, array_flip($candidatKeys))) {
            $candidatData = array_intersect_key($data, array_flip($candidatKeys));
            if (isset($candidatData['portfolio_public'])) {
                $candidatData['portfolio_public'] = (bool) $candidatData['portfolio_public'];
            }
            $user->candidat->update($candidatData);
        }

        $recruteurKeys = ['entreprise', 'poste', 'site_web', 'ville', 'gouvernorat', 'description'];
        if ($user->recruteur && array_intersect_key($data, array_flip($recruteurKeys))) {
            $recruteurData = array_intersect_key($data, array_flip($recruteurKeys));
            if (isset($data['company_description'])) {
                $recruteurData['description'] = $data['company_description'];
            }
            $user->recruteur->update($recruteurData);
        }

        if ($user->recruteur && array_key_exists('skill_ids', $data) && is_array($data['skill_ids'])) {
            $user->recruteur->skills()->sync($data['skill_ids']);
        }

        $user->refresh()->load(['candidat', 'recruteur', 'recruteur.skills']);

        return response()->json([
            'message' => 'Profil mis à jour.',
            'user' => $user,
        ]);
    }

    /**
     * Change le mot de passe de l'utilisateur connecté.
     */
    public function updatePassword(ChangePasswordRequest $request): JsonResponse
    {
        $user = $request->user();
        $user->update(['password' => $request->validated('password')]);

        return response()->json([
            'message' => 'Mot de passe modifié avec succès.',
        ]);
    }

    /**
     * Retourne les préférences / paramètres de l'utilisateur (profil + préférences stockées).
     */
    public function getSettings(Request $request): JsonResponse
    {
        $user = $request->user();
        $user->load(['candidat', 'recruteur', 'recruteur.skills']);

        $prefs = $user->preferences ?? [];
        if ($user->candidat) {
            $portfolioPublic = (bool) $user->candidat->portfolio_public;
            $prefs['career'] = array_merge($prefs['career'] ?? [], [
                'portfolioVisible' => $portfolioPublic,
            ]);
            $prefs['studentProfil'] = array_merge($prefs['studentProfil'] ?? [], [
                'visibilitePublicPrive' => $portfolioPublic,
            ]);
        }
        if ($user->recruteur) {
            $prefs['form'] = $prefs['form'] ?? [];
            $prefs['form']['siteWeb'] = $user->recruteur->site_web ?? '';
        }
        if ($user->isAdmin()) {
            $prefs['adminSecurity'] = array_merge($prefs['adminSecurity'] ?? [], [
                'politiqueMotDePasse' => AppSetting::getValue('password_policy', 'standard'),
            ]);
        }

        return response()->json(['preferences' => $prefs]);
    }

    /**
     * Enregistre les préférences / paramètres de l'utilisateur.
     */
    public function updateSettings(UpdateSettingsRequest $request): JsonResponse
    {
        $user = $request->user();
        $payload = $request->validated();

        $user->update(['preferences' => $payload['preferences'] ?? []]);

        if ($user->candidat) {
            $careerVisible = $payload['preferences']['career']['portfolioVisible'] ?? null;
            $profilPublic = $payload['preferences']['studentProfil']['visibilitePublicPrive'] ?? null;
            $public = $careerVisible !== null ? (bool) $careerVisible : ($profilPublic !== null ? (bool) $profilPublic : null);
            if ($public !== null) {
                $user->candidat->update(['portfolio_public' => $public]);
            }
        }

        if ($user->isAdmin() && isset($payload['preferences']['adminSecurity'])) {
            $sec = $payload['preferences']['adminSecurity'];
            if (isset($sec['politiqueMotDePasse']) && in_array($sec['politiqueMotDePasse'], ['simple', 'standard', 'strict'], true)) {
                AppSetting::setValue('password_policy', $sec['politiqueMotDePasse']);
            }
        }

        $user->load(['candidat', 'recruteur', 'recruteur.skills']);

        return response()->json([
            'message' => 'Paramètres enregistrés.',
            'preferences' => $user->preferences,
        ]);
    }
}

