<?php

/**
 * Fichier des routes API (Laravel).
 *
 * Toutes les URLs définies ici sont préfixées par /api par Laravel.
 * Exemple : Route::post('/login', ...) => POST http://127.0.0.1:8000/api/login
 *
 * Le frontend React appelle ces URLs via axios (voir frontend/src/api/axios.js).
 */

use App\Http\Controllers\Api\AdminOffresController;
use App\Http\Controllers\Api\AdminProjectsController;
use App\Http\Controllers\Api\AdminSkillsController;
use App\Http\Controllers\Api\AdminStatsController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ForgotPasswordController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\PortfolioController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\OffreController;
use App\Http\Controllers\Api\OfferController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Api\ConversationController;
use App\Http\Controllers\Api\RecommendationController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\SkillController;
use App\Http\Controllers\Api\UserSkillController;
use Illuminate\Support\Facades\Route;

// ========== ROUTES PUBLIQUES (pas de token requis) ==========

// Inscription : le frontend envoie POST /api/register avec name, email, password, role_id, etc.
Route::post('/register', [AuthController::class, 'register']);

// Connexion : le frontend envoie POST /api/login avec email et password. Laravel renvoie { user, token }.
Route::post('/login', [AuthController::class, 'login']);

// Mot de passe oublié : OTP par e-mail (15 min), puis nouveau mot de passe.
Route::post('/password/email', [ForgotPasswordController::class, 'sendOtp'])->middleware('throttle:6,1');
Route::post('/password/reset', [ForgotPasswordController::class, 'reset'])->middleware('throttle:10,1');

// Portfolio public : n'importe qui peut voir le portfolio d'un candidat avec GET /api/portfolio/123 (id = candidat_id).
Route::get('/portfolio/{id}', [PortfolioController::class, 'show']);
Route::get('/portfolio/{id}/download-pdf', [StudentController::class, 'downloadPDF']);

// Compétences / technologies (catalogue pour inscription recruteur).
Route::get('/skills/public-catalog', [SkillController::class, 'publicCatalog']);

// Formulaire de contact (footer), sans authentification.
Route::post('/contact', [ContactController::class, 'store'])->middleware('throttle:15,1');

// ========== ROUTES PROTÉGÉES (auth:sanctum) — sans e-mail vérifiée ==========
// Permet /me, vérification OTP et renvoi du code tant que email_verified_at est null.

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/auth/verify-email', [AuthController::class, 'verifyEmail']);
    Route::post('/verify-otp', [AuthController::class, 'verifyEmail']);
    Route::post('/auth/resend-verification', [AuthController::class, 'resendVerificationEmail'])
        ->middleware('throttle:6,1');
    Route::post('/resend-otp', [AuthController::class, 'resendVerificationEmail'])
        ->middleware('throttle:6,1');
});

// ========== ROUTES PROTÉGÉES + e-mail vérifiée (MustVerifyEmail / email_verified_at) ==========

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // Profil : mise à jour des infos (nom, photo, etc.) et du mot de passe / paramètres.
    Route::match(['put', 'post'], '/profile', [ProfileController::class, 'update']);
    Route::put('/profile/password', [ProfileController::class, 'updatePassword']);
    Route::get('/profile/settings', [ProfileController::class, 'getSettings']);
    Route::put('/profile/settings', [ProfileController::class, 'updateSettings']);

    // Catalogue de toutes les compétences (pour les listes déroulantes, etc.).
    Route::get('/all-skills', [SkillController::class, 'index']);

    // Compétences déclarées par le candidat connecté (table pivot candidat_skill avec niveau).
    Route::get('/user-skills', [UserSkillController::class, 'index']);
    Route::post('/user-skills', [UserSkillController::class, 'store']);
    Route::delete('/user-skills/{skillId}', [UserSkillController::class, 'destroy']);

    // Matching candidat : entreprises (recommandations) et offres actives (compétences offre_skill).
    Route::get('/recommendations/offres', [RecommendationController::class, 'offres'])->middleware('throttle:5,1');
    Route::get('/recommendations', [RecommendationController::class, 'index'])->middleware('throttle:5,1');
    Route::get('/recommendations/missing-skills', [RecommendationController::class, 'missingSkills']);

    // Messagerie candidat ↔ recruteur (chaque participant ne voit que ses conversations).
    Route::middleware('role:candidat,recruteur')->group(function () {
        Route::get('/conversations/unread-total', [ConversationController::class, 'unreadTotal']);
        Route::get('/conversations', [ConversationController::class, 'index']);
        Route::post('/conversations', [ConversationController::class, 'store']);
        Route::get('/conversations/{conversation}', [ConversationController::class, 'show']);
        Route::post('/conversations/{conversation}/read', [ConversationController::class, 'markAsRead']);
        Route::get('/conversations/{conversation}/messages', [ConversationController::class, 'messages']);
        Route::post('/conversations/{conversation}/messages', [ConversationController::class, 'storeMessage']);
    });

    // Offres publiées par le recruteur connecté (CRUD) ; l'admin liste toutes les offres.
    Route::get('/offres', [OffreController::class, 'index'])->middleware('role:recruteur,admin');
    Route::post('/offres', [OffreController::class, 'store'])->middleware('role:recruteur');
    Route::put('/offres/{offre}', [OffreController::class, 'update'])->middleware('role:recruteur,admin');
    Route::delete('/offres/{offre}', [OffreController::class, 'destroy'])->middleware('role:recruteur,admin');

    // Offres (alias anglais « offers ») : liste (même logique que GET /offres), publication, matching.
    Route::get('/offers', [OffreController::class, 'index'])->middleware('role:recruteur,admin');
    Route::post('/offers', [OfferController::class, 'store'])->middleware('role:recruteur');
    Route::put('/offers/{offre}', [OffreController::class, 'update'])->middleware('role:recruteur,admin');
    Route::delete('/offers/{offre}', [OffreController::class, 'destroy'])->middleware('role:recruteur,admin');
    Route::get('/offers/{offer}/matching-students', [OfferController::class, 'getMatchingStudents'])->middleware('role:recruteur,admin');

    // Projets du portfolio : POST autorisé sur update pour multipart (FormData) — PUT seul ne remplit pas toujours $_FILES côté PHP.
    Route::apiResource('projects', ProjectController::class)->except(['update']);
    Route::match(['put', 'post'], '/projects/{project}', [ProjectController::class, 'update']);

    // Legacy French aliases: certains clients utilisent `/api/projets`.
    Route::get('/projets', [ProjectController::class, 'index']);
    Route::post('/projets', [ProjectController::class, 'store']);
    Route::get('/projets/{project}', [ProjectController::class, 'show']);
    Route::match(['put', 'post'], '/projets/{project}', [ProjectController::class, 'update']);
    Route::delete('/projets/{project}', [ProjectController::class, 'destroy']);

    // Recherche de candidats : réservée aux recruteurs et admins (middleware role:recruteur,admin).
    Route::get('/search/suggested-students', [SearchController::class, 'suggestedStudents'])->middleware('role:recruteur,admin');
    Route::get('/search/students', [SearchController::class, 'students'])->middleware('role:recruteur,admin');

    // ========== ROUTES ADMIN UNIQUEMENT (middleware role:admin) ==========
    // Seuls les utilisateurs dont le rôle est "admin" peuvent appeler ces URLs.

    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/stats', [AdminStatsController::class, 'stats']);
        Route::get('/admin/users', [AdminStatsController::class, 'indexUsers']);
        Route::get('/admin/users/{id}/audit', [AdminStatsController::class, 'auditUser']);
        Route::delete('/admin/users/{id}', [AdminStatsController::class, 'destroyUser']);
        Route::get('/admin/projects', [AdminProjectsController::class, 'index']);
        Route::delete('/admin/projects/{id}', [AdminProjectsController::class, 'destroy']);
        Route::get('/admin/offres', [AdminOffresController::class, 'index']);
        Route::patch('/admin/offres/{id}', [AdminOffresController::class, 'updateActive']);
        Route::delete('/admin/offres/{id}', [AdminOffresController::class, 'destroy']);
        Route::get('/admin/skills', [AdminSkillsController::class, 'index']);
        Route::get('/admin/skills/categories', [AdminSkillsController::class, 'categories']);
        Route::post('/admin/skills', [AdminSkillsController::class, 'store']);
        Route::put('/admin/skills/{id}', [AdminSkillsController::class, 'update']);
        Route::delete('/admin/skills/{id}', [AdminSkillsController::class, 'destroy']);
    });
});
