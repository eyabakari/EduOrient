<?php

namespace App\Http\Requests;

use App\Models\Role;
use App\Services\PasswordPolicy;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $merge = [];
        foreach (['linkedin', 'bio', 'specialite', 'niveau_etude'] as $key) {
            if ($this->has($key) && $this->input($key) === '') {
                $merge[$key] = null;
            }
        }

        $roleId = (int) $this->input('role_id', 0);
        if (! $this->filled('role') && $roleId > 0) {
            $legacy = Role::fromLegacyRoleId($roleId);
            if ($legacy) {
                $merge['role'] = $legacy;
            }
        }

        if ($merge !== []) {
            $this->merge($merge);
        }
    }

    public function rules(): array
    {
        $governorates = config('tunisia.governorates', []);
        $role = $this->input('role');
        $roleId = (int) $this->input('role_id', 0);
        $isEtudiant = in_array($role, [Role::NAME_ETUDIANT, Role::NAME_CANDIDAT], true)
            || $roleId === 2;
        $isRecruteur = $role === Role::NAME_RECRUTEUR
            || $roleId === 3;

        $linkedinRules = $isEtudiant
            ? ['nullable', 'string', 'url', 'max:500']
            : ['nullable', 'string', 'max:500'];

        return [
            'role_id' => ['nullable', 'integer', Rule::in([2, 3])],
            'role' => ['nullable', 'string', Rule::in([Role::NAME_ETUDIANT, Role::NAME_CANDIDAT, Role::NAME_RECRUTEUR])],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'confirmed', PasswordPolicy::rule()],
            'photo' => ['nullable', 'image', 'max:2048'],
            'bio' => [$isEtudiant ? 'required' : 'nullable', 'string', 'max:2000'],
            'niveau_etude' => ['nullable', 'string', 'max:100'],
            'specialite' => [$isEtudiant ? 'required' : 'nullable', 'string', 'max:255'],
            'linkedin' => $linkedinRules,
            'entreprise' => [$isRecruteur ? 'required' : 'nullable', 'string', 'max:255'],
            'poste' => ['nullable', 'string', 'max:255'],
            'ville' => [$isRecruteur ? 'required' : 'nullable', 'string', 'max:120'],
            'gouvernorat' => [$isRecruteur ? 'required' : 'nullable', 'string', 'max:120', Rule::in($governorates)],
            'company_description' => ['nullable', 'string', 'min:20', 'max:5000'],
            'skill_ids' => ['nullable', 'array', 'min:1'],
            'skill_ids.*' => ['integer', 'exists:competences,id'],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $role = $this->input('role');
            $roleId = (int) $this->input('role_id', 0);
            if (! $role && ! in_array($roleId, [2, 3], true)) {
                $validator->errors()->add('role_id', 'Le rôle est obligatoire.');
            }
        });
    }

    public function messages(): array
    {
        return [
            'role_id.in' => 'Le rôle sélectionné n\'est pas valide.',
            'name.required' => 'Le nom est obligatoire.',
            'email.required' => 'L\'adresse e-mail est obligatoire.',
            'email.unique' => 'Cette adresse e-mail est déjà utilisée.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
            'gouvernorat.in' => 'Le gouvernorat sélectionné n\'est pas valide.',
            'skill_ids.min' => 'Sélectionnez au moins une technologie ou compétence utilisée par l\'entreprise.',
            'linkedin.url' => 'Le lien LinkedIn doit être une URL valide (ou laissez le champ vide).',
        ];
    }
}
