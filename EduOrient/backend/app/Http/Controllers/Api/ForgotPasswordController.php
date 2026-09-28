<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordEmailRequest;
use App\Http\Requests\ResetPasswordOtpRequest;
use App\Models\User;
use App\Services\PasswordResetOtpService;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

/**
 * Réinitialisation du mot de passe par OTP (e-mail à 6 chiffres, valable 15 minutes).
 */
class ForgotPasswordController extends Controller
{
    public function __construct(
        private PasswordResetOtpService $passwordResetOtpService
    ) {}

    /**
     * POST /api/password/email — envoie un code OTP à l’adresse indiquée.
     */
    public function sendOtp(ForgotPasswordEmailRequest $request): JsonResponse
    {
        $email = $request->validated('email');
        $user = User::query()->where('email', $email)->first();

        if (! $user) {
            throw ValidationException::withMessages([
                'email' => ['Email non trouvé.'],
            ]);
        }

        $this->passwordResetOtpService->issueAndSend($user);

        return response()->json([
            'message' => 'Un code de réinitialisation a été envoyé à votre adresse e-mail.',
        ]);
    }

    /**
     * POST /api/password/reset — vérifie le code et définit le nouveau mot de passe.
     */
    public function reset(ResetPasswordOtpRequest $request): JsonResponse
    {
        $data = $request->validated();
        $email = $data['email'];

        $user = User::query()->where('email', $email)->first();
        if (! $user) {
            throw ValidationException::withMessages([
                'email' => ['Email non trouvé.'],
            ]);
        }

        if (! $this->passwordResetOtpService->verify($email, $data['code'])) {
            throw ValidationException::withMessages([
                'code' => ['Code invalide ou expiré.'],
            ]);
        }

        $user->update(['password' => $data['new_password']]);
        $this->passwordResetOtpService->deleteForEmail($email);
        $user->tokens()->delete();

        return response()->json([
            'message' => 'Votre mot de passe a été réinitialisé. Vous pouvez vous connecter.',
        ]);
    }
}

