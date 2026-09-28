<?php

namespace Database\Factories;

use App\Models\Offre;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Offre>
 */
class OffreFactory extends Factory
{
    protected $model = Offre::class;

    public function definition(): array
    {
        $titres = [
            'Développeur React / TypeScript',
            'Stage Laravel / Vue.js',
            'Intégrateur Web — Full stack',
            'Ingénieur Backend Node.js',
            'Stage DevOps & Cloud (AWS)',
            'Développeur Mobile Flutter',
            'Alternance API REST & microservices',
            'Stage Frontend — Design system',
            'Ingénieur logiciel Java / Spring Boot',
            'Développeur Python / Django',
            'Stage intégration CI/CD & Docker',
            'Consultant technique — solutions SaaS',
            'Développeur Angular — applications métier',
            'Stage sécurité & qualité API',
            'Ingénieur données & Backend',
        ];

        $contextesLocaux = [
            'Équipe basée à Tunis ; projets pour clients en Tunisie et Maghreb. Télétravail partiel possible.',
            'Vous rejoignez la direction technique à Sfax, en lien avec les équipes Cloud du siège.',
            'Mission en mode agile pour le secteur public (administration tunisienne) : exigences API fortes.',
            'Environnement startup à Sousse : stack moderne, déploiements fréquents, culture DevOps.',
            'Produits SaaS utilisés par des banques et assurances en Tunisie ; conformité et qualité API.',
            'Projet Mobile grand public : forte volumétrie, monitoring et scalabilité sur Cloud AWS.',
        ];

        $ctx = fake()->randomElement($contextesLocaux);
        $kw = 'Stack : Frontend (SPA), Backend (API REST), déploiement Cloud, sensibilisation Mobile (PWA). ';
        $desc = $ctx.' '.$kw.fake()->paragraph(2);

        return [
            'titre' => fake()->randomElement($titres),
            'description' => $desc,
            'type' => fake()->randomElement([Offre::TYPE_STAGE, Offre::TYPE_EMPLOI]),
            'lieu' => fake()->randomElement([
                'Tunis', 'Sfax', 'Sousse', 'Gabès', 'Monastir', 'Bizerte', 'Nabeul',
                'Remote (Tunisie)', 'Hybride — Tunis', 'Les Berges du Lac', 'Technopole El Ghazala',
            ]),
            'is_active' => true,
        ];
    }

    public function stage(): static
    {
        return $this->state(fn () => ['type' => Offre::TYPE_STAGE]);
    }

    public function emploi(): static
    {
        return $this->state(fn () => ['type' => Offre::TYPE_EMPLOI]);
    }
}
