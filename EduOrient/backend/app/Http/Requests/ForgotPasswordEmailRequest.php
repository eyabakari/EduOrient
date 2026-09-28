<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ForgotPasswordEmailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email', 'max:255'],
        ];
    }

    public function attributes(): array
    {
        return [
            'email' => 'adresse e-mail',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'L’adresse e-mail est obligatoire.',
            'email.email' => 'L’adresse e-mail n’est pas valide.',
        ];
    }
}
