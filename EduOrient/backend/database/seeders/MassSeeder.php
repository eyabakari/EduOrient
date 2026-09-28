<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Competence;
use App\Models\candidat;
use App\Models\Offre;
use App\Models\Project;
use App\Models\Recruteur;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * Volume de données réalistes (PFE) : 50 étudiants (compétences + projets), 15 recruteurs, 25 offres.
 *
 * Prérequis : {@see RoleSeeder}, {@see SkillSeeder} (table skills non vide).
 */
class MassSeeder extends Seeder
{
    private const LEVELS = ['beginner', 'intermediate', 'expert'];

    /** @var list<string> */
    private const BIOS_ETU = [
        'Étudiant(e) en informatique, motivé(e) par les projets web et les APIs en contexte tunisien.',
        'Stages et PFE autour du Backend, du Frontend et du Mobile ; sensibilité aux enjeux Cloud.',
        'Participation à des projets tutorés (ISET, FST, ESPRIT) et intérêt pour l\'emploi local.',
        'Veille technologique sur l\'écosystème startup à Sfax, Tunis et Sousse.',
    ];

    public function run(): void
    {
        $skillIds = Competence::query()->orderBy('id')->pluck('id')->values();
        if ($skillIds->count() < 10) {
            $this->command?->warn('MassSeeder ignoré : exécutez d’abord SkillSeeder (moins de 10 compétences).');

            return;
        }

        $this->command?->info('MassSeeder : création de 50 étudiants…');
        $this->seedcandidats($skillIds);

        $this->command?->info('MassSeeder : création de 15 recruteurs…');
        $recruteurs = $this->seedRecruteurs();

        $this->command?->info('MassSeeder : création de 25 offres…');
        $this->seedOffres($skillIds, $recruteurs);

        $this->command?->info('MassSeeder terminé.');
    }

    private function seedcandidats(Collection $skillIds): void
    {
        $snippetsProjet = [
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

        for ($i = 0; $i < 50; $i++) {
            $user = User::factory()->candidat()->create();

            $etu = Candidat::query()->create([
                'user_id' => $user->id,
                'bio' => fake()->randomElement(self::BIOS_ETU).' '.fake()->randomElement($snippetsProjet).' '.fake()->sentence(10),
                'niveau_etude' => fake()->randomElement(['Licence', 'Master', 'Ingénieur', 'BTS']),
                'specialite' => fake()->randomElement([
                    'Génie logiciel — ESPRIT',
                    'Informatique — INSAT',
                    'Réseaux & télécom — FST',
                    'Systèmes d\'information — ISG',
                    'Développement web & Mobile — ISET Sousse',
                    'Informatique de gestion — FSEG Sfax',
                    'Génie informatique — ENIT',
                    'Technologies numériques — ISET Sidi Bouzid',
                ]),
                'linkedin' => fake()->boolean(55)
                    ? 'https://linkedin.com/in/'.Str::slug(Str::ascii($user->name), '-')
                    : null,
                'portfolio_public' => fake()->boolean(42),
            ]);

            $nSkills = random_int(6, min(10, $skillIds->count()));
            $chosen = $skillIds->shuffle()->take($nSkills)->values();
            $sync = [];
            foreach ($chosen as $skillId) {
                $sync[(int) $skillId] = ['level' => fake()->randomElement(self::LEVELS)];
            }
            $etu->skills()->sync($sync);

            $chosenIds = $chosen->map(fn ($id) => (int) $id)->all();
            $nProjects = random_int(1, 3);
            Project::factory()
                ->count($nProjects)
                ->create(['candidat_id' => $etu->id])
                ->each(function (Project $project) use ($chosenIds) {
                    if ($chosenIds === []) {
                        return;
                    }
                    $max = count($chosenIds);
                    $k = random_int(min(2, $max), min(5, $max));
                    $pSkillIds = collect($chosenIds)->shuffle()->take($k)->values()->all();
                    $project->skills()->sync($pSkillIds);
                });
        }
    }

    /**
     * @return Collection<int, Recruteur>
     */
    private function seedRecruteurs(): Collection
    {
        $gouvernorats = ['Tunis', 'Ariana', 'Ben Arous', 'Sfax', 'Sousse', 'Monastir', 'Nabeul', 'Gabès'];

        $entreprises = [
            'Proxym IT', 'Telnet Holding', 'Vermeg Tunisie', 'Sopra Steria Tunisie',
            'Astrolab Tunisie', 'Complys Tunisie', 'Actia Engineering', 'Steq Ingénierie',
            'Crystal System', 'Softylis', 'Medianet', 'Key Performance', 'Datawords Tunisie',
            'Orange Tunisie — DSI', 'Ooredoo Tunisia', 'Banque Zitouna — Digital',
            'BIAT — Innovation', 'STEG — Direction SI', 'Ministère — projet e-admin',
        ];

        $snippetsOffre = [
            'Équipe basée à Tunis ; projets pour clients en Tunisie et Maghreb. Télétravail partiel possible.',
            'Vous rejoignez la direction technique à Sfax, en lien avec les équipes Cloud du siège.',
            'Mission en mode agile pour le secteur public (administration tunisienne) : exigences API fortes.',
            'Environnement startup à Sousse : stack moderne, déploiements fréquents, culture DevOps.',
            'Produits SaaS utilisés par des banques et assurances en Tunisie ; conformité et qualité API.',
            'Projet Mobile grand public : forte volumétrie, monitoring et scalabilité sur Cloud AWS.',
        ];

        $out = collect();
        for ($i = 0; $i < 15; $i++) {
            $user = User::factory()->recruteur()->create();
            $ville = fake()->randomElement(['Tunis', 'Sfax', 'Sousse', 'Lac 2', 'Centre urbain Nord', 'Sahloul', 'El Menzah']);
            $gov = fake()->randomElement($gouvernorats);

            $entreprise = fake()->randomElement($entreprises);

            $rec = Recruteur::query()->create([
                'user_id' => $user->id,
                'entreprise' => $entreprise,
                'poste' => fake()->randomElement(['Chargé de recrutement IT', 'Talent Acquisition', 'RH technique', 'Responsable carrières']),
                'site_web' => fake()->boolean(70) ? 'https://www.'.(Str::slug(Str::ascii($entreprise)) ?: 'societe-'.Str::lower(Str::random(4))).'.tn' : null,
            ]);

            Company::query()->create([
                'user_id' => $user->id,
                'name' => $rec->entreprise,
                'ville' => $ville,
                'gouvernorat' => $gov,
                'description' => fake()->paragraph(2).' '.fake()->randomElement($snippetsOffre).' Activités autour du Backend, du Frontend, des APIs, du Cloud et du Mobile pour le marché tunisien.',
            ]);

            $out->push($rec);
        }

        return $out;
    }

    private function seedOffres(Collection $skillIds, Collection $recruteurs): void
    {
        if ($recruteurs->isEmpty()) {
            return;
        }

        for ($i = 0; $i < 25; $i++) {
            /** @var Recruteur $rec */
            $rec = $recruteurs->random();

            $offre = Offre::factory()
                ->for($rec, 'recruteur')
                ->create();

            $n = random_int(4, min(7, $skillIds->count()));
            $ids = $skillIds->shuffle()->take($n)->all();
            $offre->skills()->sync($ids);
        }
    }
}

