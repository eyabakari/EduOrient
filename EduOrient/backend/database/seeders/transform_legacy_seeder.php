<?php

/**
 * Transforme DatabaseSeeder.php (ancien schéma) vers le nouveau schéma UML.
 * Usage: php database/seeders/transform_legacy_seeder.php
 */

$source = __DIR__.'/DatabaseSeeder.php';
$target = __DIR__.'/DatabaseSeeder.php';
$backup = __DIR__.'/DatabaseSeeder.php.backup';

if (! file_exists($source)) {
    fwrite(STDERR, "Fichier introuvable: {$source}\n");
    exit(1);
}

$content = file_get_contents($source);
if (! copy($source, $backup)) {
    fwrite(STDERR, "Impossible de créer la sauvegarde.\n");
    exit(1);
}

function extractInserts(string $content): array
{
    $tables = [];
    $offset = 0;
    $needle = "DB::table('";
    while (($pos = strpos($content, $needle, $offset)) !== false) {
        $startTable = $pos + strlen($needle);
        $endTable = strpos($content, "')", $startTable);
        $table = substr($content, $startTable, $endTable - $startTable);

        $insertPos = strpos($content, '->insert([', $endTable);
        $arrayStart = strpos($content, '[', $insertPos);
        $depth = 0;
        $i = $arrayStart;
        $len = strlen($content);
        while ($i < $len) {
            $ch = $content[$i];
            if ($ch === '[') {
                $depth++;
            } elseif ($ch === ']') {
                $depth--;
                if ($depth === 0) {
                    $arrayEnd = $i;
                    break;
                }
            }
            $i++;
        }
        $arrayCode = substr($content, $arrayStart, $arrayEnd - $arrayStart + 1);
        /** @var array<int, array<string, mixed>> $rows */
        $rows = eval('return '.$arrayCode.';');
        $tables[$table][] = $rows;

        $offset = $arrayEnd + 1;
    }

    return $tables;
}

function roleFromId(int $roleId): string
{
    return match ($roleId) {
        1 => 'admin',
        2 => 'candidat',
        3 => 'recruteur',
        default => 'candidat',
    };
}

function normalizeCategorie(?string $cat): string
{
    if ($cat === null || trim($cat) === '') {
        return 'Technique';
    }
    $lower = mb_strtolower(trim($cat), 'UTF-8');
    if (str_contains($lower, 'langue') || in_array($lower, ['français', 'francais', 'anglais', 'arabe', 'allemand'], true)) {
        return 'Langue';
    }

    return 'Technique';
}

$tables = extractInserts($content);

$companiesByUser = [];
foreach ($tables['companies'] ?? [] as $rows) {
    foreach ($rows as $row) {
        $companiesByUser[(int) $row['user_id']] = $row;
    }
}

$candidatIdMap = [];
foreach ($tables['candidats'] ?? [] as $rows) {
    foreach ($rows as $row) {
        $oldId = (int) $row['id'];
        $newId = (int) $row['user_id'];
        $candidatIdMap[$oldId] = $newId;
    }
}

$recruteurIdMap = [];
foreach ($tables['recruteurs'] ?? [] as $rows) {
    foreach ($rows as $row) {
        $oldId = (int) $row['id'];
        $newId = (int) $row['user_id'];
        $recruteurIdMap[$oldId] = $newId;
    }
}

// Langues → compétences Langue (nouveaux IDs après catalogue skills)
$maxCompetenceId = 0;
foreach ($tables['skills'] ?? [] as $rows) {
    foreach ($rows as $row) {
        $maxCompetenceId = max($maxCompetenceId, (int) $row['id']);
    }
}

$langueCompetenceByKey = [];
$languePivotRows = [];
foreach ($tables['langues'] ?? [] as $rows) {
    foreach ($rows as $row) {
        $nom = ucfirst(trim((string) $row['nom']));
        $key = mb_strtolower($nom, 'UTF-8');
        if (! isset($langueCompetenceByKey[$key])) {
            $maxCompetenceId++;
            $langueCompetenceByKey[$key] = $maxCompetenceId;
        }
        $etuOld = (int) $row['candidat_id'];
        $etuNew = $candidatIdMap[$etuOld] ?? $etuOld;
        $languePivotRows[] = [
            'candidat_id' => $etuNew,
            'competence_id' => $langueCompetenceByKey[$key],
            'level' => null,
            'created_at' => $row['created_at'] ?? now()->toDateTimeString(),
            'updated_at' => $row['updated_at'] ?? now()->toDateTimeString(),
        ];
    }
}

$output = [];

// USERS
$userRows = [];
foreach ($tables['users'] ?? [] as $rows) {
    foreach ($rows as $row) {
        unset($row['role_id']);
        $row['role'] = roleFromId((int) ($row['role_id'] ?? $row['role'] ?? 2));
        if (! isset($row['role'])) {
            $row['role'] = roleFromId((int) ($tables['users'][0][0]['role_id'] ?? 2));
        }
        $userRows[] = $row;
    }
}
// Fix users - role_id still in row during loop
$userRows = [];
foreach ($tables['users'] ?? [] as $rows) {
    foreach ($rows as $row) {
        $roleId = (int) ($row['role_id'] ?? 2);
        unset($row['role_id']);
        $row['role'] = roleFromId($roleId);
        $userRows[] = $row;
    }
}
$output['users'] = $userRows;

// candidatS
$etuRows = [];
foreach ($tables['candidats'] ?? [] as $rows) {
    foreach ($rows as $row) {
        $newId = (int) $row['user_id'];
        unset($row['user_id']);
        $row['id'] = $newId;
        $etuRows[] = $row;
    }
}
$output['candidats'] = $etuRows;

// RECRUTEURS (+ merge companies)
$recRows = [];
foreach ($tables['recruteurs'] ?? [] as $rows) {
    foreach ($rows as $row) {
        $userId = (int) $row['user_id'];
        $company = $companiesByUser[$userId] ?? null;
        unset($row['user_id']);
        $row['id'] = $userId;
        if ($company) {
            $row['ville'] = $row['ville'] ?? $company['ville'] ?? null;
            $row['gouvernorat'] = $row['gouvernorat'] ?? $company['gouvernorat'] ?? null;
            $row['description'] = $row['description'] ?? $company['description'] ?? null;
            if (empty($row['entreprise']) && ! empty($company['name'])) {
                $row['entreprise'] = $company['name'];
            }
        }
        if (! array_key_exists('ville', $row)) {
            $row['ville'] = null;
        }
        if (! array_key_exists('gouvernorat', $row)) {
            $row['gouvernorat'] = null;
        }
        if (! array_key_exists('description', $row)) {
            $row['description'] = null;
        }
        $recRows[] = $row;
    }
}
$output['recruteurs'] = $recRows;

// COMPETENCES (ex-skills + langues)
$compRows = [];
foreach ($tables['skills'] ?? [] as $rows) {
    foreach ($rows as $row) {
        unset($row['name'], $row['category']);
        $row['categorie'] = normalizeCategorie($row['categorie'] ?? null);
        $compRows[] = $row;
    }
}
foreach ($langueCompetenceByKey as $nomKey => $id) {
    $nom = ucfirst($nomKey);
    $compRows[] = [
        'id' => $id,
        'nom' => $nom,
        'categorie' => 'Langue',
        'created_at' => '2026-04-25 00:01:50',
        'updated_at' => '2026-04-25 00:01:50',
    ];
}
$output['competences'] = $compRows;

// candidat_COMPETENCE
$ecRows = [];
$pivotId = 1;
foreach ($tables['candidat_skill'] ?? [] as $rows) {
    foreach ($rows as $row) {
        $oldEtu = (int) $row['candidat_id'];
        $row['candidat_id'] = $candidatIdMap[$oldEtu] ?? $oldEtu;
        $row['competence_id'] = (int) $row['skill_id'];
        unset($row['skill_id']);
        $row['id'] = $pivotId++;
        $ecRows[] = $row;
    }
}
foreach ($languePivotRows as $lp) {
    $ecRows[] = [
        'id' => $pivotId++,
        'candidat_id' => $lp['candidat_id'],
        'competence_id' => $lp['competence_id'],
        'level' => $lp['level'],
        'created_at' => $lp['created_at'],
        'updated_at' => $lp['updated_at'],
    ];
}
$output['candidat_competence'] = $ecRows;

// PROJETS
$projRows = [];
foreach ($tables['projects'] ?? [] as $rows) {
    foreach ($rows as $row) {
        $oldEtu = (int) $row['candidat_id'];
        $row['candidat_id'] = $candidatIdMap[$oldEtu] ?? $oldEtu;
        $projRows[] = $row;
    }
}
$output['projets'] = $projRows;

// PROJET_COMPETENCE
$pcRows = [];
$pivotId = 1;
foreach ($tables['project_skill'] ?? [] as $rows) {
    foreach ($rows as $row) {
        $row['projet_id'] = (int) $row['project_id'];
        unset($row['project_id']);
        $row['competence_id'] = (int) $row['skill_id'];
        unset($row['skill_id']);
        $row['id'] = $pivotId++;
        $pcRows[] = $row;
    }
}
$output['projet_competence'] = $pcRows;

// PROJET_IMAGES
$piRows = [];
foreach ($tables['project_images'] ?? [] as $rows) {
    foreach ($rows as $row) {
        $row['projet_id'] = (int) $row['project_id'];
        unset($row['project_id']);
        $piRows[] = $row;
    }
}
$output['projet_images'] = $piRows;

// OFFRES
$offreRows = [];
foreach ($tables['offres'] ?? [] as $rows) {
    foreach ($rows as $row) {
        $oldRec = (int) $row['recruteur_id'];
        $row['recruteur_id'] = $recruteurIdMap[$oldRec] ?? $oldRec;
        $offreRows[] = $row;
    }
}
$output['offres'] = $offreRows;

// OFFRE_COMPETENCE
$ocRows = [];
$pivotId = 1;
foreach ($tables['offre_skill'] ?? [] as $rows) {
    foreach ($rows as $row) {
        $row['competence_id'] = (int) $row['skill_id'];
        unset($row['skill_id']);
        $row['id'] = $pivotId++;
        $ocRows[] = $row;
    }
}
$output['offre_competence'] = $ocRows;

// RECRUTEUR_COMPETENCE
$rcRows = [];
$pivotId = 1;
foreach ($tables['recruteur_skill'] ?? [] as $rows) {
    foreach ($rows as $row) {
        $oldRec = (int) $row['recruteur_id'];
        $row['recruteur_id'] = $recruteurIdMap[$oldRec] ?? $oldRec;
        $row['competence_id'] = (int) $row['skill_id'];
        unset($row['skill_id']);
        $row['id'] = $pivotId++;
        $rcRows[] = $row;
    }
}
$output['recruteur_competence'] = $rcRows;

// CONVERSATIONS
$convRows = [];
foreach ($tables['conversations'] ?? [] as $rows) {
    foreach ($rows as $row) {
        $oldEtu = (int) $row['candidat_id'];
        $oldRec = (int) $row['recruteur_id'];
        $row['candidat_id'] = $candidatIdMap[$oldEtu] ?? $oldEtu;
        $row['recruteur_id'] = $recruteurIdMap[$oldRec] ?? $oldRec;
        $convRows[] = $row;
    }
}
$output['conversations'] = $convRows;

// Tables inchangées
foreach (['contacts', 'email_verifications', 'messages'] as $t) {
    if (! empty($tables[$t])) {
        $output[$t] = array_merge(...$tables[$t]);
    }
}

$order = [
    'users',
    'candidats',
    'recruteurs',
    'competences',
    'candidat_competence',
    'projets',
    'projet_competence',
    'projet_images',
    'offres',
    'offre_competence',
    'recruteur_competence',
    'conversations',
    'messages',
    'contacts',
    'email_verifications',
];

$php = "<?php\n\nnamespace Database\\Seeders;\n\nuse Illuminate\\Database\\Seeder;\nuse Illuminate\\Support\\Facades\\DB;\n\n/**\n * Données importées — schéma UML (competences, projets, héritage users).\n * Généré par transform_legacy_seeder.php — sauvegarde : DatabaseSeeder.php.backup\n */\nclass DatabaseSeeder extends Seeder\n{\n    public function run(): void\n    {\n        DB::statement('PRAGMA foreign_keys = OFF');\n\n";

foreach ($order as $table) {
    if (empty($output[$table])) {
        continue;
    }
    $php .= "        DB::table('{$table}')->insert(".var_export($output[$table], true).");\n\n";
}

$php .= "        DB::statement('PRAGMA foreign_keys = ON');\n    }\n}\n";

file_put_contents($target, $php);

echo "Transformation terminée.\n";
echo "- Sauvegarde : DatabaseSeeder.php.backup\n";
echo "- Fichier généré : DatabaseSeeder.php\n";
echo 'Tables : '.implode(', ', array_keys($output))."\n";

