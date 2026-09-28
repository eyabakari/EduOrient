<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function downloadPDF(Request $request, string $id)
    {
        $currentUser = $request->user();

        $student = Candidat::with([
            'user:id,name,email,photo',
            'competences' => fn ($query) => $query->select('competences.id', 'competences.nom', 'competences.categorie'),
            'projets' => fn ($query) => $query->select([
                'projets.id',
                'projets.candidat_id',
                'projets.titre',
                'projets.description',
                'projets.lien_github',
                'projets.lien_demo',
                'projets.date_debut',
                'projets.date_fin',
            ])->with([
                'competences' => fn ($query) => $query->select('competences.id', 'competences.nom'),
            ]),
            'langues' => fn ($query) => $query->select('competences.id', 'competences.nom'),
        ])->find($id);

        if (! $student) {
            return response()->json(['message' => 'Étudiant introuvable.'], 404);
        }

        $isOwner = $currentUser && $currentUser->candidat && (int) $currentUser->candidat->id === (int) $student->id;
        if (! $student->portfolio_public && ! $isOwner) {
            return response()->json(['message' => 'Ce portfolio n\'est pas disponible.'], 403);
        }

        $technicalSkills = [];
        $softSkills = [];
        foreach ($student->competences as $competence) {
            $label = $competence->nom ?? $competence->name;
            $item = [
                'id' => $competence->id,
                'name' => $label,
                'category' => $competence->categorie ?? $competence->category,
            ];

            if (strtolower((string) ($competence->categorie ?? $competence->category)) === 'soft skills') {
                $softSkills[] = $item;
            } else {
                $technicalSkills[] = $item;
            }
        }

        $projects = $student->projets->map(function ($project) {
            return [
                'titre' => $project->titre,
                'description' => $project->description,
                'lien_github' => $project->lien_github,
                'lien_demo' => $project->lien_demo,
                'date_debut' => $project->date_debut ? Carbon::parse($project->date_debut)->format('Y') : null,
                'date_fin' => $project->date_fin ? Carbon::parse($project->date_fin)->format('Y') : 'Présent',
                'skills' => $project->competences->map(fn ($skill) => $skill->nom ?? $skill->name)->filter()->values()->all(),
            ];
        })->values()->all();

        $languages = $student->langues->map(fn ($language) => [
            'nom' => $language->nom,
            'niveau' => data_get($language, 'pivot.level') ?? null,
        ])->values()->all();

        $profileTitle = $student->specialite ? 'Étudiant·e en ' . $student->specialite : 'Profil étudiant';
        $profilePhone = data_get($student, 'user.phone', '');
        $profileName = data_get($student, 'user.name', 'Étudiant');
        $profileEmail = data_get($student, 'user.email', '');

        $formationTitle = trim((string) ($student->niveau_etude ?? '') . ' ' . (string) ($student->specialite ?? '')) ?: null;
        $education = [];
        if ($formationTitle) {
            $education[] = [
                'programme' => $formationTitle,
                'institution' => 'Établissement non renseigné',
                'dates' => 'En cours',
            ];
        }

        try {
            $pdf = Pdf::loadView('pdf.portfolio', [
                'profileName' => $profileName,
                'profileTitle' => $profileTitle,
                'profileEmail' => $profileEmail,
                'profilePhone' => $profilePhone,
                'summary' => $student->bio ?? 'Résumé non renseigné.',
                'education' => $education,
                'experiences' => [],
                'projects' => $projects,
                'technicalSkills' => $technicalSkills,
                'softSkills' => $softSkills,
                'languages' => $languages,
            ]);

            $filename = 'CV_' . preg_replace('/[^A-Za-z0-9_-]+/', '_', $profileName) . '.pdf';

            return $pdf->download($filename);
        } catch (\Exception $e) {
            Log::error("Erreur PDF : " . $e->getMessage(), [
                'exception' => $e,
            ]);

            return response()->json([
                'error' => 'Erreur interne de génération',
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ], 500);
        }
    }
}

