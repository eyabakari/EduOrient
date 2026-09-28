<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function configure(): static
    {
        return $this->afterCreating(function (Project $project): void {
            $count = fake()->numberBetween(2, 3);
            for ($i = 0; $i < $count; $i++) {
                try {
                    $response = Http::timeout(20)->get('https://picsum.photos/400/300');
                    if (! $response->successful()) {
                        continue;
                    }
                    $binary = $response->body();
                    if ($binary === '' || $binary === false) {
                        continue;
                    }
                    $path = 'projects/seed_'.Str::random(16).'.jpg';
                    Storage::disk('public')->put($path, $binary);
                    ProjectImage::query()->create([
                        'project_id' => $project->id,
                        'image_path' => $path,
                    ]);
                } catch (\Throwable) {
                    // Réseau indisponible ou picsum en erreur : on ignore pour ne pas bloquer le seed.
                }
            }
        });
    }

    public function definition(): array
    {
        $titres = [
            'API REST de gestion des stages',
            'Dashboard analytique temps réel',
            'Application mobile de livraison',
            'Plateforme e-learning (SPA)',
            'Microservices de facturation',
            'Portail recruteur — matching compétences',
            'CI/CD et observabilité (stack Cloud)',
            'Module Frontend React + design system',
            'Backend Laravel — authentification & rôles',
            'Intégration paiement & webhooks',
        ];

        $contextesLocaux = [
            'Contexte : startup tech à Sfax, besoin d\'une API et d\'un tableau de bord pour suivre les livraisons.',
            'Réalisé dans le cadre d\'un projet tutoré à l\'ISET Sidi Bouzid : gestion des stages et des conventions.',
            'Plateforme pour une association à Kairouan : collecte en ligne et suivi des bénéficiaires.',
            'PFE à l\'ESPRIT : application de covoiturage inter-villes (Tunis—Sousse—Sfax).',
            'Projet de fin d\'études sur le transport en Tunisie : optimisation des lignes et réservation Mobile.',
            'Hackathon « Tunis Smart City » : prototype Frontend + Backend exposant des données ouvertes.',
            'Stage à Tunis — Les Berges du Lac : intégration d\'un module de paiement pour une fintech locale.',
            'Cahier des charges fourni par une PME de Monastir : gestion de stock et facturation Cloud.',
            'Collaboration avec un cabinet comptable à Bizerte : portail client et exports comptables.',
            'Projet universitaire FST : suivi des bus campus et notifications temps réel (API + Mobile).',
            'Application pour une ONG à Gabès : sensibilisation environnementale et cartographie.',
            'Défi national innovation : solution e-santé pour un centre à Nabeul (API sécurisée).',
        ];

        $slug = 'repo-'.Str::lower(Str::random(10));
        $titre = fake()->randomElement($titres);
        $local = fake()->randomElement($contextesLocaux);

        $desc = implode(' ', [
            $local,
            'Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive.',
            'Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI.',
            'Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD).',
            'Mots-clés : API, Backend, Frontend, Cloud, Mobile.',
        ]);

        return [
            'titre' => $titre,
            'description' => $desc.' '.fake()->paragraph(2),
            'lien_github' => 'https://github.com/'.$slug,
            'lien_demo' => fake()->boolean(35) ? 'https://demo-pfe.tn/'.$slug : null,
            'date_debut' => fake()->dateTimeBetween('-10 months', '-2 months'),
            'date_fin' => fake()->boolean(70) ? fake()->dateTimeBetween('-1 months', 'now') : null,
            'image' => null,
        ];
    }
}
