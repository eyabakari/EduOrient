<?php

namespace App\Console\Commands;

use App\Models\Candidat;
use Illuminate\Console\Command;

class SyncOldProjectsSkills extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-old-projects-skills';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Début de la synchronisation des anciennes compétences...');

        // N-jibou el candidats el kol li 3andhom des projets
        $candidats = Candidat::with('projects.skills')->get();

        foreach ($candidats as $candidat) {
            $allProjectSkills = [];

            foreach ($candidat->projects as $project) {
                // N-lemou el IDs mta3 el skills mta3 m-projets el kol
                $allProjectSkills = array_merge($allProjectSkills, $project->skills->pluck('id')->toArray());
            }

            if (!empty($allProjectSkills)) {
                // N-na7iou el IDs el m3awdin
                $uniqueSkills = array_unique($allProjectSkills);
                
                // SyncWithoutDetaching bech n-zidouhom lel profil 
                $candidat->skills()->syncWithoutDetaching($uniqueSkills);
            }
        }

        $this->info('Synchronisation terminée avec succès !');
    }
}
