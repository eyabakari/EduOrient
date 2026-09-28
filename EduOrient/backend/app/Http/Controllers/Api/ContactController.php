<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\AdminContactNotification;
use App\Models\Contact;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Enregistre un message de contact (formulaire footer, sans authentification).
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
        ], [
            'email.required' => 'L’adresse e-mail est obligatoire.',
            'email.email' => 'L’adresse e-mail n’est pas valide.',
            'message.required' => 'Le message est obligatoire.',
            'message.min' => 'Le message doit contenir au moins :min caractères.',
        ]);

        $contact = Contact::query()->create([
            'email' => $validated['email'],
            'message' => $validated['message'],
            'status' => 'pending',
        ]);

        $adminEmail = config('mail.admin_address');
        if (is_string($adminEmail) && filter_var($adminEmail, FILTER_VALIDATE_EMAIL)) {
            Mail::to($adminEmail)->send(new AdminContactNotification($contact));
        }

        return response()->json([
            'message' => 'Votre message a bien été envoyé. Nous vous répondrons dès que possible.',
        ], 201);
    }
}

