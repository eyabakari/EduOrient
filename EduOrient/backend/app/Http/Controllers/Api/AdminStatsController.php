<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Competence;
use App\Models\Candidat;
use App\Models\Project;
use App\Models\Recruteur;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Statistiques et gestion admin : stats dashboard, liste utilisateurs, suppression.
 * Réservé au rôle admin.
 */
class AdminStatsController extends Controller
{
    /**
     * GET /api/admin/users
     */
    public function indexUsers(Request $request): JsonResponse
    {
        $perPage = max(5, min((int) $request->input('per_page', 15), 50));
        $users = User::with(['candidat', 'recruteur'])
            ->orderByDesc('created_at')
            ->paginate($perPage);

        return response()->json([
            'data' => $users->items(),
            'meta' => [
                'current_page' => $users->currentPage(),
                'last_page' => $users->lastPage(),
                'per_page' => $users->perPage(),
                'total' => $users->total(),
            ],
        ]);
    }

    /**
     * GET /api/admin/users/{id}/audit
     * Details de moderation rattaches a un utilisateur.
     */
    public function auditUser(int $id): JsonResponse
    {
        // Charge l'utilisateur sans eager-loading profond pour éviter des requêtes
        // complexes provoquant des erreurs d'alias/colonnes ambiguës sous SQLite.
        $user = User::find($id);

        if (! $user) {
            return response()->json(['message' => 'Utilisateur introuvable.'], 404);
        }

        $roleName = $user->role;

        if ($roleName === Role::NAME_ETUDIANT || $roleName === Role::NAME_CANDIDAT) {
            $candidat = $user->candidat;
            $projectsQuery = Project::query()->where('candidat_id', $candidat?->id ?? 0)
                ->orderByDesc('created_at')
                ->with(['skills' => fn ($q) => $q->select('competences.id', 'competences.nom')]);

            $projects = $projectsQuery->get()->map(fn (Project $project) => [
                'id' => $project->id,
                'titre' => $project->titre,
                'description' => $project->description,
                'created_at' => $project->created_at?->toIso8601String(),
                'skills' => $project->skills
                    ->map(fn ($skill) => ['id' => $skill->id, 'nom' => $skill->nom])
                    ->values()
                    ->all(),
            ])->values()->all();

            return response()->json([
                'data' => [
                    'user' => $this->serializeAuditUser($user),
                    'type' => 'projects',
                    'items' => $projects,
                ],
            ]);
        }

        if ($roleName === 'recruteur') {
            $recruteur = $user->recruteur;
            if ($recruteur) {
                $offresQuery = $recruteur->offres()->orderByDesc('created_at')
                    ->with(['skills' => fn ($q) => $q->select('competences.id', 'competences.nom')]);

                $offres = $offresQuery->get()->map(fn ($offre) => [
                    'id' => $offre->id,
                    'titre' => $offre->titre,
                    'type' => $offre->type,
                    'description' => $offre->description,
                    'lieu' => $offre->lieu,
                    'is_active' => (bool) $offre->is_active,
                    'created_at' => $offre->created_at?->toIso8601String(),
                    'skills' => $offre->skills
                        ->map(fn ($skill) => ['id' => $skill->id, 'nom' => $skill->nom])
                        ->values()
                        ->all(),
                ])->values()->all();
            } else {
                $offres = [];
            }

            return response()->json([
                'data' => [
                    'user' => $this->serializeAuditUser($user),
                    'type' => 'offres',
                    'items' => $offres,
                ],
            ]);
        }

        return response()->json([
            'data' => [
                'user' => $this->serializeAuditUser($user),
                'type' => 'none',
                'items' => [],
            ],
        ]);
    }

    private function serializeAuditUser(User $user): array
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'photo_url' => $user->photo_url,
            'created_at' => $user->created_at?->toIso8601String(),
            'role' => $user->role ? [
                'name' => $user->role,
            ] : null,
            'candidat' => $user->candidat ? [
                'id' => $user->candidat->id,
                'specialite' => $user->candidat->specialite,
                'niveau_etude' => $user->candidat->niveau_etude,
            ] : null,
            'recruteur' => $user->recruteur ? [
                'id' => $user->recruteur->id,
                'entreprise' => $user->recruteur->entreprise,
                'poste' => $user->recruteur->poste,
            ] : null,
        ];
    }

    /**
     * DELETE /api/admin/users/{id}
     */
    public function destroyUser(Request $request, int $id): JsonResponse
    {
        if ((int) $id === (int) $request->user()?->id) {
            return response()->json(['message' => 'Vous ne pouvez pas supprimer votre propre compte.'], 403);
        }

        $user = User::find($id);
        if (! $user) {
            return response()->json(['message' => 'Utilisateur introuvable.'], 404);
        }

        $user->tokens()->delete();
        $user->delete();

        return response()->json(['message' => 'Utilisateur supprimé.'], 200);
    }

    /**
     * GET /api/admin/stats
     * Données pour le dashboard admin : cartes stats, inscrits par jour, top 5 compétences, derniers utilisateurs.
     */
    public function stats(Request $request): JsonResponse
    {
        $candidatsCount = Candidat::count();
        $recruteursCount = Recruteur::count();
        $projetsCount = Project::count();
        $competencesCount = Competence::count();

        $inscritsParJour = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $count = User::whereDate('created_at', $date)->count();
            $inscritsParJour[] = [
                'date' => $date->format('Y-m-d'),
                'jour' => $date->locale('fr')->dayName,
                'inscrits' => $count,
            ];
        }

        $top5Skills = Competence::withCount(['candidats', 'projects'])
            ->get()
            ->map(function ($s) {
                return [
                    'id' => $s->id,
                    'name' => $s->nom,
                    'total' => (int) $s->candidats_count + (int) $s->projects_count,
                ];
            })
            ->sortByDesc('total')
            ->take(5)
            ->values()
            ->all();

        $totalTop5 = array_sum(array_column($top5Skills, 'total'));
        $top5SkillsWithPercent = array_map(function ($s) use ($totalTop5) {
            $pct = $totalTop5 > 0 ? round(100 * $s['total'] / $totalTop5, 1) : 0;
            return ['name' => $s['name'], 'value' => $s['total'], 'percent' => $pct];
        }, $top5Skills);

        $dernieresInscriptions = User::with(['candidat', 'recruteur'])
            ->orderByDesc('created_at')
            ->limit(10)
            ->get()
            ->map(function ($u) {
                $roleName = $u->role ?? '—';
                $roleLabel = $roleName === Role::NAME_ETUDIANT || $roleName === Role::NAME_CANDIDAT
                    ? 'Étudiant'
                    : ($roleName === Role::NAME_RECRUTEUR ? 'Recruteur' : ucfirst($roleName));
                return [
                    'nom' => $u->name ?? '—',
                    'role' => $roleLabel,
                    'date' => $u->created_at?->format('d/m/Y'),
                    'status' => 'Inscrit',
                ];
            })
            ->all();

        return response()->json([
            'data' => [
                'candidats' => $candidatsCount,
                'recruteurs' => $recruteursCount,
                'projets' => $projetsCount,
                'competences' => $competencesCount,
                'inscrits_par_jour' => $inscritsParJour,
                'top_5_skills' => $top5SkillsWithPercent,
                'dernieres_inscriptions' => $dernieresInscriptions,
            ],
        ]);
    }
}

