<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'preferences' => ['required', 'array'],
            'preferences.general' => ['sometimes', 'array'],
            'preferences.general.theme' => ['sometimes', 'string', 'in:light,dark,system'],
            'preferences.general.langue' => ['sometimes', 'string', 'max:10'],
            'preferences.career' => ['sometimes', 'array'],
            'preferences.notifications' => ['sometimes', 'array'],
            'preferences.adminUsers' => ['sometimes', 'array'],
            'preferences.adminSecurity' => ['sometimes', 'array'],
            'preferences.adminAffichage' => ['sometimes', 'array'],
            'preferences.adminSauvegarde' => ['sometimes', 'array'],
            'preferences.adminStatistiques' => ['sometimes', 'array'],
            'preferences.studentProfil' => ['sometimes', 'array'],
            'preferences.studentPortfolio' => ['sometimes', 'array'],
            'preferences.studentProjets' => ['sometimes', 'array'],
            'preferences.studentCompetences' => ['sometimes', 'array'],
            'preferences.recruiterRecherche' => ['sometimes', 'array'],
            'preferences.recruiterVisibilite' => ['sometimes', 'array'],
            'preferences.recruiterCommunication' => ['sometimes', 'array'],
            'preferences.recruiterNotifications' => ['sometimes', 'array'],
            'preferences.recruiterAcces' => ['sometimes', 'array'],
            'preferences.system' => ['sometimes', 'array'],
        ];
    }
}
