<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Rename etudiants table to candidats
        Schema::rename('etudiants', 'candidats');

        // Rename etudiant_competence pivot table to candidat_competence
        Schema::rename('etudiant_competence', 'candidat_competence');

        // Update foreign keys in candidats table
        Schema::table('candidats', function (Blueprint $table) {
            // The foreign key constraint name might vary, so we drop by column
            $table->dropForeign(['id']); // If exists
        });

        // Update foreign keys in projets table
        Schema::table('projets', function (Blueprint $table) {
            $table->renameColumn('etudiant_id', 'candidat_id');
        });

        // Update foreign keys in conversations table
        Schema::table('conversations', function (Blueprint $table) {
            $table->renameColumn('etudiant_id', 'candidat_id');
        });

        // Update foreign keys in candidat_competence pivot table
        Schema::table('candidat_competence', function (Blueprint $table) {
            $table->renameColumn('etudiant_id', 'candidat_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse table rename
        Schema::rename('candidats', 'etudiants');
        Schema::rename('candidat_competence', 'etudiant_competence');

        // Reverse column renames in projets table
        Schema::table('projets', function (Blueprint $table) {
            $table->renameColumn('candidat_id', 'etudiant_id');
        });

        // Reverse column renames in conversations table
        Schema::table('conversations', function (Blueprint $table) {
            $table->renameColumn('candidat_id', 'etudiant_id');
        });

        // Reverse column renames in etudiant_competence pivot table
        Schema::table('etudiant_competence', function (Blueprint $table) {
            $table->renameColumn('candidat_id', 'etudiant_id');
        });
    }
};
