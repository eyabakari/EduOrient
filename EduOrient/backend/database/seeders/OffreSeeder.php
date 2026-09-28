<?php

namespace Database\Seeders;

use App\Models\Offre;
use App\Models\Recruteur;
use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Offres de démonstration et technologies d'entreprise pour le matching compétences.
 */
class OffreSeeder extends Seeder
{
    public function run(): void
    {
        // $byNom = Competence::query()->pluck('id', 'nom')->all();

        // $attach = function (Offre $offre, array $noms) use ($byNom): void {
        //     $ids = [];
        //     foreach ($noms as $nom) {
        //         if (isset($byNom[$nom])) {
        //             $ids[] = $byNom[$nom];
        //         }
        //     }
        //     if ($ids !== []) {
        //         $offre->skills()->sync($ids);
        //     }
        // };

        // $instadeep = Recruteur::whereHas('user', fn ($q) => $q->where('email', 'recrutement@instadeep.com'))->first();
        // if ($instadeep) {
        //     $instadeep->skills()->syncWithoutDetaching(array_filter([
        //         $byNom['Python'] ?? null,
        //         $byNom['Django'] ?? null,
        //         $byNom['Docker'] ?? null,
        //         $byNom['AWS'] ?? null,
        //     ]));

        //     $o = Offre::updateOrCreate(
        //         ['recruteur_id' => $instadeep->id, 'titre' => 'Stage — Ingénieur ML / Backend'],
        //         [
        //             'description' => 'Rejoignez nos équipes R&D : services Python, conteneurisation et cloud.',
        //             'type' => Offre::TYPE_STAGE,
        //             'lieu' => 'Tunis',
        //             'is_active' => true,
        //         ]
        //     );
        //     $attach($o, ['Python', 'Django', 'Docker', 'AWS']);
        // }

        // $vermeg = Recruteur::whereHas('user', fn ($q) => $q->where('email', 'rh@vermeg.com'))->first();
        // if ($vermeg) {
        //     $vermeg->skills()->syncWithoutDetaching(array_filter([
        //         $byNom['Spring Boot'] ?? null,
        //         $byNom['React.js'] ?? null,
        //     ]));

        //     $o = Offre::updateOrCreate(
        //         ['recruteur_id' => $vermeg->id, 'titre' => 'PFE / Stage — Développement full stack'],
        //         [
        //             'description' => 'Applications Java Spring et interfaces React au sein de nos squads assurance.',
        //             'type' => Offre::TYPE_STAGE,
        //             'lieu' => 'Les Berges du Lac',
        //             'is_active' => true,
        //         ]
        //     );
        //     $attach($o, ['Spring Boot', 'React.js', 'Docker']);

        //     $o2 = Offre::updateOrCreate(
        //         ['recruteur_id' => $vermeg->id, 'titre' => 'Emploi — Développeur Java confirmé'],
        //         [
        //             'description' => 'Poste CDI orienté backend microservices.',
        //             'type' => Offre::TYPE_EMPLOI,
        //             'lieu' => 'Tunis',
        //             'is_active' => true,
        //         ]
        //     );
        //     $attach($o2, ['Spring Boot', 'Docker']);
        // }

        // $talys = Recruteur::whereHas('user', fn ($q) => $q->where('email', 'contact@talys.tn'))->first();
        // if ($talys) {
        //     $talys->skills()->syncWithoutDetaching(array_filter([
        //         $byNom['Laravel'] ?? null,
        //         $byNom['Vue.js'] ?? null,
        //     ]));

        //     $o = Offre::updateOrCreate(
        //         ['recruteur_id' => $talys->id, 'titre' => 'Stage — Développeur web Laravel / Vue'],
        //         [
        //             'description' => 'Conception d\'API Laravel et SPA Vue.js pour clients régionaux.',
        //             'type' => Offre::TYPE_STAGE,
        //             'lieu' => 'Hybride',
        //             'is_active' => true,
        //         ]
        //     );
        //     $attach($o, ['Laravel', 'Vue.js', 'Docker']);
        // }

        // Portfolios publics + compétences de démo pour le matching
        // $demo = [
        //     'sarra.mansour@prolink.tn' => ['React.js', 'Laravel', 'Docker'],
        //     'mohamed.trabelsi@prolink.tn' => ['Spring Boot', 'Angular', 'Docker'],
        //     'yassine.dridi@prolink.tn' => ['Flutter', 'AWS'],
        //     'ines.chaabane@prolink.tn' => ['React.js', 'Python', 'Django', 'Vue.js'],
        // ];

        // foreach ($demo as $email => $skillNoms) {
        //     $etu = User::where('email', $email)->first()?->candidat;
        //     if (! $etu) {
        //         continue;
        //     }
        //     $etu->update(['portfolio_public' => true]);
        //     $ids = [];
        //     foreach ($skillNoms as $nom) {
        //         if (isset($byNom[$nom])) {
        //             $ids[] = $byNom[$nom];
        //         }
        //     }
        //     if ($ids !== []) {
        //         $etu->skills()->syncWithoutDetaching($ids);
        //     }
        // }
    }
}

