<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifyEmailCodeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'code' => ['required', 'string', 'regex:/^[0-9]{6}$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => 'Saisissez le code à 6 chiffres.',
            'code.regex' => 'Le code doit contenir exactement 6 chiffres.',
        ];
    }
}
