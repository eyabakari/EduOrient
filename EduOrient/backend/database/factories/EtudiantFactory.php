<?php

namespace Database\Factories;

use App\Models\Candidat;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Candidat>
 */
class EtudiantFactory extends Factory
{
    protected $model = Candidat::class;

    /** @var list<string> */
    private const BIOS = [
        'Étudiant(e) passionné(e) par le développement web et les APIs ; projets tutorés à Tunis.',
        'Intérêt pour le Backend, le Cloud et le Mobile ; participations à des événements tech en Tunisie.',
        'Expérience de projets académiques (PFE) avec stack moderne et déploiement sur serveurs cloud.',
        'Curieux(se) des bonnes pratiques DevOps et de l\'intégration continue dans les équipes tunisiennes.',
    ];

    public function definition(): array
    {
        return [
            'user_id' => User::factory()->candidat(),
            'bio' => fake()->randomElement(self::BIOS).' '.fake()->sentence(12),
            'niveau_etude' => fake()->randomElement(['Licence', 'Master', 'Ingénieur', 'BTS', 'Doctorat']),
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
            'linkedin' => fake()->boolean(65) ? 'https://linkedin.com/in/'.fake()->slug(2) : null,
            'portfolio_public' => fake()->boolean(45),
        ];
    }
}
