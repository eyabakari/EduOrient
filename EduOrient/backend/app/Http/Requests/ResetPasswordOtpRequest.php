<?php

namespace App\Http\Requests;

use App\Services\PasswordPolicy;
use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordOtpRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('code')) {
            $this->merge([
                'code' => preg_replace('/\D/', '', (string) $this->input('code')),
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email', 'max:255'],
            'code' => ['required', 'string', 'regex:/^\d{6}$/'],
            'new_password' => ['required', 'string', 'confirmed', PasswordPolicy::rule()],
        ];
    }

    public function attributes(): array
    {
        return [
            'email' => 'adresse e-mail',
            'code' => 'code',
            'new_password' => 'nouveau mot de passe',
            'new_password_confirmation' => 'confirmation du mot de passe',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'L’adresse e-mail est obligatoire.',
            'email.email' => 'L’adresse e-mail n’est pas valide.',
            'code.required' => 'Le code est obligatoire.',
            'code.regex' => 'Le code doit contenir exactement 6 chiffres.',
            'new_password.required' => 'Le nouveau mot de passe est obligatoire.',
            'new_password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
            'new_password.min' => 'Le mot de passe doit contenir au moins :min caractères.',
        ];
    }
}
