<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Candidat;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

/**
 * Contrôleur API du portfolio étudiant (vue publique / recruteurs).
 * Retourne profil, compétences et projets pour GET /api/portfolio/{id}.
 */
class PortfolioController extends Controller
{
    /**
     * Affiche le portfolio d'un étudiant par son id (candidat_id).
     */
    public function show(Request $request, string $id): JsonResponse
    {
        $currentUser = $request->user();
        if (! $currentUser && $request->bearerToken()) {
            $token = PersonalAccessToken::findToken($request->bearerToken());
            if ($token) {
                $currentUser = $token->tokenable;
                $currentUser->load('candidat');
            }
        }

        $candidat = Candidat::query()
            ->select([
                'candidats.id',
                'candidats.bio',
                'candidats.niveau_etude',
                'candidats.specialite',
                'candidats.linkedin',
                'candidats.portfolio_public',
            ])
            ->with([
                'user:id,name,photo,email,preferences',
                'skills' => fn ($q) => $q->select('competences.id', 'competences.nom', 'competences.nom', 'competences.categorie', 'competences.categorie'),
                'projects' => fn ($q) => $q
                    ->select([
                        'projets.id',
                        'projets.candidat_id',
                        'projets.titre',
                        'projets.description',
                        'projets.lien_github',
                        'projets.lien_demo',
                        'projets.image',
                        'projets.date_debut',
                        'projets.date_fin',
                    ])
                    ->with([
                        'skills' => fn ($sq) => $sq->select('competences.id', 'competences.nom', 'competences.nom'),
                        'projectImages' => fn ($sq) => $sq->select('projet_images.id', 'projet_images.projet_id', 'projet_images.image_path'),
                    ]),
            ])
            ->find($id);

        if (! $candidat) {
            return response()->json(['message' => 'Portfolio introuvable.'], 404);
        }

        $isOwner = $currentUser && $currentUser->candidat && (int) $currentUser->candidat->id === (int) $candidat->id;
        $canView = $candidat->portfolio_public || $isOwner;
        if (! $canView) {
            return response()->json(['message' => 'Ce portfolio n\'est pas visible.'], 403);
        }

        $user = $candidat->user;
        $ownerPrefs = is_array($user?->preferences ?? null) ? $user->preferences : [];
        $visibiliteProjets = $ownerPrefs['studentProjets']['visibiliteProjets'] ?? 'recruteur';
        $afficherSoftSkills = $ownerPrefs['studentCompetences']['afficherSoftSkills'] ?? true;

        $isAdmin = $currentUser && $currentUser->role === 'admin';
        $isRecruiter = $currentUser && $currentUser->role === 'recruteur';

        $showProjects = $isOwner
            || ($visibiliteProjets === 'admin' && $isAdmin)
            || ($visibiliteProjets === 'recruteur' && ($isAdmin || $isRecruiter));

        $technicalSkills = [];
        $softSkills = [];
        foreach ($candidat->skills as $skill) {
            $item = [
                'id' => $skill->id,
                'name' => $skill->name ?? $skill->nom,
                'nom' => $skill->nom,
                'categorie' => $skill->categorie,
                'category' => $skill->category,
            ];
            if (strtolower($skill->categorie ?? '') === 'soft skills') {
                $softSkills[] = $item;
            } else {
                $technicalSkills[] = $item;
            }
        }
        if (! $afficherSoftSkills) {
            $softSkills = [];
        }

        $projectsRaw = $showProjects
            ? $candidat->projects
            : collect();
        $projects = $projectsRaw->map(function ($project) {
            return [
                'id' => $project->id,
                'titre' => $project->titre,
                'description' => $project->description,
                'lien_github' => $project->lien_github,
                'lien_demo' => $project->lien_demo,
                'image_url' => $project->image_url,
                'gallery' => $project->projectImages->map(fn ($img) => [
                    'id' => $img->id,
                    'url' => $img->url,
                ])->values()->all(),
                'date_debut' => $project->date_debut?->format('Y-m-d'),
                'date_fin' => $project->date_fin?->format('Y-m-d'),
                'skills' => $project->skills->map(fn ($s) => ['id' => $s->id, 'nom' => $s->nom])->values()->all(),
            ];
        })->values()->all();

        return response()->json([
            'data' => [
                'profile' => [
                    'name' => $user?->name ?? 'Étudiant',
                    'email' => $user?->email,
                    'photo_url' => $user?->photo_url,
                    'specialite' => $candidat->specialite,
                    'niveau_etude' => $candidat->niveau_etude,
                    'bio' => $candidat->bio,
                    'linkedin' => $candidat->linkedin,
                ],
                'skills' => [
                    'technical' => $technicalSkills,
                    'soft' => $softSkills,
                ],
                'projects' => $projects,
            ],
        ]);
    }
}

