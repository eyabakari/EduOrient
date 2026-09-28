<?php

namespace App\Services;

use App\Mail\ResetPasswordMail;
use App\Models\PasswordResetOtp;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * OTP par e-mail (6 chiffres) pour la réinitialisation du mot de passe (durée 15 minutes).
 */
class PasswordResetOtpService
{
    private const TTL_MINUTES = 15;

    /**
     * Génère un code, l’enregistre (hash) et envoie l’e-mail.
     */
    public function issueAndSend(User $user): void
    {
        $plain = str_pad((string) random_int(0, 999_999), 6, '0', STR_PAD_LEFT);

        PasswordResetOtp::query()->updateOrCreate(
            ['email' => $user->email],
            [
                'code' => Hash::make($plain),
                'expires_at' => now()->addMinutes(self::TTL_MINUTES),
            ]
        );

        try {
            Mail::to($user->email)->send(new ResetPasswordMail($user->name, $plain));
        } catch (\Throwable $e) {
            Log::warning('password_reset_otp_send_failed', [
                'email' => $user->email,
                'message' => $e->getMessage(),
            ]);
            if (app()->environment('local')) {
                Log::info("DEV — OTP réinitialisation pour {$user->email} : {$plain}");
            }
        }
    }

    /**
     * Vérifie que le code est valide et non expiré (sans le consommer).
     */
    public function verify(string $email, string $plainCode): bool
    {
        $plainCode = preg_replace('/\D/', '', $plainCode) ?? '';
        if (strlen($plainCode) !== 6) {
            return false;
        }

        $record = PasswordResetOtp::query()->where('email', $email)->first();
        if (! $record || $record->expires_at->isPast()) {
            return false;
        }

        return Hash::check($plainCode, $record->code);
    }

    public function deleteForEmail(string $email): void
    {
        PasswordResetOtp::query()->where('email', $email)->delete();
    }
}
