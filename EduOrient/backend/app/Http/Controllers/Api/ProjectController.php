<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Services\ProjectService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Contrôleur API des projets du portfolio étudiant.
 *
 * Le frontend appelle ces routes avec le token Bearer (étudiant connecté). Les routes sont
 * GET /api/projects (index), POST /api/projects (store), GET/PUT/DELETE /api/projects/{id}.
 * ProjectPolicy vérifie que l'étudiant connecté est bien le propriétaire du projet (candidat_id).
 */
class ProjectController extends Controller
{
    public function __construct(
        private ProjectService $projectService
    ) {}

    /**
     * Fichiers galerie : clé `images` ou `images[]` (tableau), ou clés numérotées `images.0`, …
     *
     * @return list<\Illuminate\Http\UploadedFile>
     */
    private function galleryFilesFromRequest(Request $request): array
    {
        $out = [];

        $batch = $request->file('images');
        if ($batch instanceof \Illuminate\Http\UploadedFile) {
            $out[] = $batch;
        } elseif (is_array($batch)) {
            foreach ($batch as $f) {
                if ($f instanceof \Illuminate\Http\UploadedFile) {
                    $out[] = $f;
                }
            }
        }

        foreach ($request->allFiles() as $key => $file) {
            if ($key === 'images' || $key === 'image') {
                continue;
            }
            if (! is_string($key)) {
                continue;
            }
            if (preg_match('/^images\[\d*\]$/', $key) === 1 || preg_match('/^images\.\d+$/', $key) === 1) {
                if ($file instanceof \Illuminate\Http\UploadedFile) {
                    $out[] = $file;
                }
            }
        }

        $seen = [];
        $deduped = [];
        foreach ($out as $f) {
            if (! $f instanceof \Illuminate\Http\UploadedFile || ! $f->isValid()) {
                continue;
            }
            $h = spl_object_hash($f);
            if (isset($seen[$h])) {
                continue;
            }
            $seen[$h] = true;
            $deduped[] = $f;
        }

        return $deduped;
    }

    /**
     * GET /api/projects – Liste tous les projets de l'étudiant connecté.
     */
    public function index(Request $request): JsonResponse
    {
        $this->authorize('viewAny', Project::class);

        $projets = Project::where('candidat_id', auth()->id())
            ->with([
                'competences' => fn ($q) => $q->select('competences.id', 'competences.nom', 'competences.categorie'),
                'projetImages' => fn ($q) => $q->select('projet_images.id', 'projet_images.projet_id', 'projet_images.image_path'),
            ])
            ->orderByDesc('created_at')
            ->get();

        return response()->json($projets, 200);
    }

    /**
     * Affiche un projet (propriétaire uniquement).
     */
    public function show(Project $project): JsonResponse
    {
        $this->authorize('view', $project);

        $project->load([
            'skills' => fn ($q) => $q->select('competences.id', 'competences.nom', 'competences.nom', 'competences.categorie', 'competences.categorie'),
            'projetImages' => fn ($q) => $q->select('projet_images.id', 'projet_images.projet_id', 'projet_images.image_path'),
        ]);

        return response()->json(['data' => $project]);
    }

    /**
     * Crée un projet et associe les compétences (skill_ids, skill_names). Gère l'upload d'image.
     */
    public function store(ProjectRequest $request): JsonResponse
    {
        $this->authorize('create', Project::class);

        $data = $request->validated();
        unset($data['image'], $data['images']);
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $data['image'] = Storage::disk('public')->putFile('project-images', $request->file('image'));
        }

        $candidat = $request->user()->candidat;
        $project = $this->projectService->createProject($data, $candidat->id);

        $gallery = $this->galleryFilesFromRequest($request);
        if ($gallery !== []) {
            $this->projectService->syncGalleryImages($project, $gallery);
        }

        $project = $this->projectService->loadProjectRelationsForApi($project->fresh());

        return response()->json([
            'message' => __('Projet créé avec succès.'),
            'data' => $project,
        ], 201);
    }

    /**
     * Met à jour un projet (propriétaire uniquement). Gère le remplacement de l'image.
     */
    public function update(ProjectRequest $request, Project $project): JsonResponse
    {
        $this->authorize('update', $project);

        $data = $request->validated();
        unset($data['image'], $data['images']);
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $data['image'] = Storage::disk('public')->putFile('project-images', $request->file('image'));
        }

        $project = $this->projectService->updateProject($project, $data);

        $gallery = $this->galleryFilesFromRequest($request);
        if ($gallery !== []) {
            $this->projectService->syncGalleryImages($project, $gallery);
        }

        $project = $this->projectService->loadProjectRelationsForApi($project->fresh());

        return response()->json([
            'message' => __('Projet modifié avec succès.'),
            'data' => $project,
        ]);
    }

    /**
     * Supprime un projet (propriétaire uniquement).
     */
    public function destroy(Project $project): JsonResponse
    {
        $this->authorize('delete', $project);

        $this->projectService->deleteProject($project);

        return response()->json([
            'message' => __('Projet supprimé avec succès.'),
        ], 200);
    }
}

