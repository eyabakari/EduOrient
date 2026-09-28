<?php

namespace App\Http\Requests;

use App\Services\PasswordPolicy;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', PasswordPolicy::rule()],
        ];
    }

    public function attributes(): array
    {
        return [
            'current_password' => 'mot de passe actuel',
            'password' => 'nouveau mot de passe',
        ];
    }

    public function messages(): array
    {
        return [
            'current_password.current_password' => 'Le mot de passe actuel est incorrect.',
            'password.required' => 'Le nouveau mot de passe est obligatoire.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
            'password.min' => 'Le mot de passe doit contenir au moins :min caractères.',
        ];
    }
}
