<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $user = $this->user();
        $rules = [
            'name' => ['sometimes', 'string', 'max:255'],
            'photo' => ['nullable', 'image', 'max:2048'],
        ];

        if ($user && $user->isEtudiant()) {
            $rules['bio'] = ['nullable', 'string', 'max:2000'];
            $rules['niveau_etude'] = ['nullable', 'string', 'max:100'];
            $rules['specialite'] = ['nullable', 'string', 'max:255'];
            $rules['linkedin'] = ['nullable', 'url', 'max:500'];
            $rules['portfolio_public'] = ['nullable', 'boolean'];
        }

        if ($user && $user->isRecruteur()) {
            $rules['entreprise'] = ['nullable', 'string', 'max:255'];
            $rules['poste'] = ['nullable', 'string', 'max:255'];
            $rules['site_web'] = ['nullable', 'string', 'url', 'max:500'];
            $rules['ville'] = ['nullable', 'string', 'max:120'];
            $rules['gouvernorat'] = ['nullable', 'string', 'max:120', Rule::in(config('tunisia.governorates', []))];
            $rules['company_description'] = ['nullable', 'string', 'min:20', 'max:5000'];
            $rules['skill_ids'] = ['nullable', 'array'];
            $rules['skill_ids.*'] = ['integer', 'exists:competences,id'];
        }

        return $rules;
    }

    public function attributes(): array
    {
        return [
            'name' => 'nom',
            'photo' => 'photo de profil',
            'bio' => 'biographie',
            'specialite' => 'spécialité',
            'linkedin' => 'profil LinkedIn',
            'entreprise' => 'entreprise',
            'poste' => 'poste',
            'ville' => 'ville',
            'gouvernorat' => 'gouvernorat',
            'company_description' => 'description de l\'entreprise',
            'skill_ids' => 'technologies',
        ];
    }
}
