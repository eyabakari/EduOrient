<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\VerifyEmailCodeRequest;
use App\Services\AuthService;
use App\Services\EmailVerificationOtpService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

/**
 * Contrôleur API d'authentification : inscription, connexion, utilisateur courant.
 *
 * Comment le frontend l'utilise :
 * - Page Login : appelle login() avec { email, password } → reçoit { user, token } et les stocke (AuthContext + localStorage).
 * - Page Register : appelle register() avec les champs du formulaire → idem.
 * - Après chargement de l'app : appelle me() avec le token en header pour récupérer user à jour (avec role, etudiant, recruteur).
 */
class AuthController extends Controller
{
    public function __construct(
        private AuthService $authService,
        private EmailVerificationOtpService $emailVerificationOtpService
    ) {}

    /**
     * Inscription (POST /api/register).
     *
     * 1. Valide les données (RegisterRequest : name, email, password, role_id, etc.).
     * 2. AuthService crée le User en base et le profil (Candidat ou Recruteur) selon role_id.
     * 3. Crée un token Sanctum pour que le frontend soit "connecté" tout de suite.
     * 4. Renvoie { message, user, token, token_type } en JSON. Le frontend stocke user + token.
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $data = $request->validated();
        $photo = $data['photo'] ?? null;
        unset($data['photo']);
        $user = $this->authService->register($data, $photo);
        $user->sendEmailVerificationNotification();
        $token = $user->createToken('register')->plainTextToken;

        return response()->json([
            'message' => __('Compte créé. Un code de vérification a été envoyé à votre adresse e-mail.'),
            'user' => $user->fresh()->load(['candidat', 'recruteur', 'recruteur.skills']),
            'token' => $token,
            'token_type' => 'Bearer',
            'requires_email_verification' => true,
        ], 201);
    }

    /**
     * POST /api/auth/verify-email — vérifie le code OTP (utilisateur connecté).
     */
    public function verifyEmail(VerifyEmailCodeRequest $request): JsonResponse
    {
        $user = $request->user();
        if ($user->hasVerifiedEmail()) {
            return response()->json([
                'message' => __('Votre adresse e-mail est déjà vérifiée.'),
                'user' => $user->load(['candidat', 'recruteur', 'recruteur.skills']),
            ]);
        }

        $ok = $this->emailVerificationOtpService->verify($user, $request->validated('code'));
        if (! $ok) {
            throw ValidationException::withMessages([
                'code' => [__('Code invalide ou expiré. Demandez un nouveau code.')],
            ]);
        }

        $user->refresh()->load(['candidat', 'recruteur', 'recruteur.skills']);

        return response()->json([
            'message' => __('Adresse e-mail vérifiée avec succès.'),
            'user' => $user,
        ]);
    }

    /**
     * POST /api/auth/resend-verification — renvoie un code OTP (limite de fréquence).
     */
    public function resendVerificationEmail(Request $request): JsonResponse
    {
        $user = $request->user();
        if ($user->hasVerifiedEmail()) {
            return response()->json(['message' => __('Votre adresse e-mail est déjà vérifiée.')], 422);
        }

        $key = 'resend-verification:'.$user->id;
        if (RateLimiter::tooManyAttempts($key, 4)) {
            $seconds = RateLimiter::availableIn($key);

            return response()->json([
                'message' => __('Trop de demandes. Réessayez dans :seconds secondes.', ['seconds' => $seconds]),
            ], 429);
        }
        RateLimiter::hit($key, 60);

        $user->sendEmailVerificationNotification();

        return response()->json([
            'message' => __('Un nouveau code vous a été envoyé par e-mail.'),
        ]);
    }

    /**
     * Connexion (POST /api/login).
     *
     * 1. Valide email + password (LoginRequest).
     * 2. AuthService vérifie les identifiants et crée un token Sanctum.
     * 3. Renvoie { message, user, token, token_type }. Le frontend stocke user + token et redirige vers /dashboard.
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $result = $this->authService->login($request->validated());

        return response()->json([
            'message' => __('Connexion réussie.'),
            'user' => $result['user'],
            'token' => $result['token'],
            'token_type' => 'Bearer',
        ]);
    }

    /**
     * Utilisateur connecté (GET /api/me). Route protégée par auth:sanctum.
     *
     * Le frontend envoie le token dans le header Authorization. Laravel retrouve l'utilisateur et charge
     * ses relations (role, etudiant, recruteur) pour que le frontend ait tout (dont user.role.name pour les redirections).
     */
    public function me(Request $request): JsonResponse
    {
        $user = $request->user();
        $user->load(['candidat', 'recruteur', 'recruteur.skills']);

        return response()->json([
            'user' => $user,
        ]);
    }
}

