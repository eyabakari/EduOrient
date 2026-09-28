<?php

namespace App\Services;

use App\Mail\VerificationCodeMail;
use App\Models\EmailVerification;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * OTP par e-mail (6 chiffres) pour la vérification post-inscription.
 */
class EmailVerificationOtpService
{
    private const TTL_MINUTES = 15;

    /**
     * Génère un code, l’enregistre (hash) et envoie l’e-mail.
     */
    public function issueAndSend(User $user): string
    {
        $plain = str_pad((string) random_int(0, 999_999), 6, '0', STR_PAD_LEFT);

        EmailVerification::query()->updateOrCreate(
            ['email' => $user->email],
            [
                'code' => Hash::make($plain),
                'expires_at' => now()->addMinutes(self::TTL_MINUTES),
            ]
        );

        try {
            Mail::to($user->email)->send(new VerificationCodeMail($user->name, $plain));
        } catch (\Throwable $e) {
            Log::warning('email_verification_send_failed', [
                'email' => $user->email,
                'message' => $e->getMessage(),
            ]);
            if (app()->environment('local')) {
                Log::info("DEV — OTP pour {$user->email} : {$plain}");
            }
        }

        return $plain;
    }

    /**
     * Vérifie le code, active l’e-mail si valide.
     */
    public function verify(User $user, string $plainCode): bool
    {
        $plainCode = preg_replace('/\D/', '', $plainCode) ?? '';
        if (strlen($plainCode) !== 6) {
            return false;
        }

        $record = EmailVerification::query()->where('email', $user->email)->first();
        if (! $record || $record->expires_at->isPast()) {
            return false;
        }

        if (! Hash::check($plainCode, $record->code)) {
            return false;
        }

        if (! $user->markEmailAsVerified()) {
            return false;
        }

        $record->delete();

        return true;
    }
}
