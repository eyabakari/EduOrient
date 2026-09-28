<?php

namespace Database\Seeders;

use App\Models\Competence;
use Illuminate\Database\Seeder;

/**
 * Catalogue IT : colonnes `name` et `category` (sync `nom` / `categorie` via le modèle Competence).
 * Aucune suppression — updateOrCreate sur `name` pour idempotence et conservation des pivots existants.
 */
class SkillSeeder extends Seeder
{
    private const CAT_DATABASES = 'Bases de Données';

    private const CAT_AI_DATA = 'Intelligence Artificielle & Data';

    private const CAT_DESIGN_OTHER = 'Outils de Design & Autres';

    /**
     * @var list<array{name: string, category: string}>
     */
    private array $skills = [
        // ——— 1. Développement Web (Frontend) — Languages
        ['name' => 'HTML5', 'category' => 'Frontend Web'],
        ['name' => 'CSS3', 'category' => 'Frontend Web'],
        ['name' => 'JavaScript (ES6+)', 'category' => 'Frontend Web'],
        ['name' => 'TypeScript', 'category' => 'Frontend Web'],
        // Frameworks / Libraries
        ['name' => 'React.js', 'category' => 'Frontend Web'],
        ['name' => 'Vue.js', 'category' => 'Frontend Web'],
        ['name' => 'Angular', 'category' => 'Frontend Web'],
        ['name' => 'Svelte', 'category' => 'Frontend Web'],
        ['name' => 'Next.js', 'category' => 'Frontend Web'],
        ['name' => 'Nuxt.js', 'category' => 'Frontend Web'],
        // Styling
        ['name' => 'Tailwind CSS', 'category' => 'Frontend Web'],
        ['name' => 'Bootstrap', 'category' => 'Frontend Web'],
        ['name' => 'Sass/SCSS', 'category' => 'Frontend Web'],
        ['name' => 'Material UI', 'category' => 'Frontend Web'],
        ['name' => 'DaisyUI', 'category' => 'Frontend Web'],

        // ——— 2. Développement Web (Backend) — Languages
        ['name' => 'PHP', 'category' => 'Backend Web'],
        ['name' => 'Node.js', 'category' => 'Backend Web'],
        ['name' => 'Python', 'category' => 'Backend Web'],
        ['name' => 'Java', 'category' => 'Backend Web'],
        ['name' => 'C#', 'category' => 'Backend Web'],
        ['name' => 'Go', 'category' => 'Backend Web'],
        ['name' => 'Ruby', 'category' => 'Backend Web'],
        ['name' => 'Rust', 'category' => 'Backend Web'],
        // Frameworks
        ['name' => 'Laravel', 'category' => 'Backend Web'],
        ['name' => 'Express.js', 'category' => 'Backend Web'],
        ['name' => 'NestJS', 'category' => 'Backend Web'],
        ['name' => 'Django', 'category' => 'Backend Web'],
        ['name' => 'Flask', 'category' => 'Backend Web'],
        ['name' => 'Spring Boot', 'category' => 'Backend Web'],
        ['name' => 'ASP.NET Core', 'category' => 'Backend Web'],
        // APIs
        ['name' => 'REST API', 'category' => 'Backend Web'],
        ['name' => 'GraphQL', 'category' => 'Backend Web'],
        ['name' => 'WebSockets', 'category' => 'Backend Web'],
        ['name' => 'gRPC', 'category' => 'Backend Web'],

        // ——— 3. Développement Mobile ———
        ['name' => 'React Native', 'category' => 'Mobile'],
        ['name' => 'Flutter', 'category' => 'Mobile'],
        ['name' => 'Expo', 'category' => 'Mobile'],
        ['name' => 'Ionic', 'category' => 'Mobile'],
        ['name' => 'Kotlin (Android)', 'category' => 'Mobile'],
        ['name' => 'Swift (iOS)', 'category' => 'Mobile'],
        ['name' => 'Objective-C', 'category' => 'Mobile'],

        // ——— 4. Bases de Données — Relational (SQL)
        ['name' => 'MySQL', 'category' => self::CAT_DATABASES],
        ['name' => 'PostgreSQL', 'category' => self::CAT_DATABASES],
        ['name' => 'MariaDB', 'category' => self::CAT_DATABASES],
        ['name' => 'SQL Server', 'category' => self::CAT_DATABASES],
        ['name' => 'SQLite', 'category' => self::CAT_DATABASES],
        // Non-Relational (NoSQL)
        ['name' => 'MongoDB', 'category' => self::CAT_DATABASES],
        ['name' => 'Firebase Firestore', 'category' => self::CAT_DATABASES],
        ['name' => 'Redis', 'category' => self::CAT_DATABASES],
        ['name' => 'Cassandra', 'category' => self::CAT_DATABASES],

        // ——— 5. DevOps & Cloud ———
        ['name' => 'Docker', 'category' => 'DevOps & Cloud'],
        ['name' => 'Kubernetes', 'category' => 'DevOps & Cloud'],
        ['name' => 'Git', 'category' => 'DevOps & Cloud'],
        ['name' => 'GitHub Actions', 'category' => 'DevOps & Cloud'],
        ['name' => 'GitLab CI/CD', 'category' => 'DevOps & Cloud'],
        ['name' => 'Jenkins', 'category' => 'DevOps & Cloud'],
        ['name' => 'AWS', 'category' => 'DevOps & Cloud'],
        ['name' => 'Google Cloud (GCP)', 'category' => 'DevOps & Cloud'],
        ['name' => 'Azure', 'category' => 'DevOps & Cloud'],
        ['name' => 'Vercel', 'category' => 'DevOps & Cloud'],
        ['name' => 'Netlify', 'category' => 'DevOps & Cloud'],

        // ——— 6. Intelligence Artificielle & Data ———
        ['name' => 'TensorFlow', 'category' => self::CAT_AI_DATA],
        ['name' => 'PyTorch', 'category' => self::CAT_AI_DATA],
        ['name' => 'Scikit-learn', 'category' => self::CAT_AI_DATA],
        ['name' => 'Pandas', 'category' => self::CAT_AI_DATA],
        ['name' => 'NumPy', 'category' => self::CAT_AI_DATA],
        ['name' => 'Machine Learning', 'category' => self::CAT_AI_DATA],
        ['name' => 'Deep Learning', 'category' => self::CAT_AI_DATA],
        ['name' => 'NLP (Natural Language Processing)', 'category' => self::CAT_AI_DATA],

        // ——— 7. Outils de Design & Autres ———
        ['name' => 'Figma', 'category' => self::CAT_DESIGN_OTHER],
        ['name' => 'Adobe XD', 'category' => self::CAT_DESIGN_OTHER],
        ['name' => 'Jest', 'category' => self::CAT_DESIGN_OTHER],
        ['name' => 'Cypress', 'category' => self::CAT_DESIGN_OTHER],
        ['name' => 'Postman (API Testing)', 'category' => self::CAT_DESIGN_OTHER],
    ];

    public function run(): void
    {
        foreach ($this->skills as $row) {
            $name = $row['name'];
            $category = $row['category'];
            Competence::updateOrCreate(
                ['nom' => $name],
                [
                    'categorie' => $category,
                    'nom' => $name,
                ]
            );
        }
    }
}

