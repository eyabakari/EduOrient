<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('etudiant_competence', function (Blueprint $table) {
            $table->id();
            $table->foreignId('etudiant_id')->constrained('etudiants')->cascadeOnDelete();
            $table->foreignId('competence_id')->constrained('competences')->cascadeOnDelete();
            $table->string('level', 32)->nullable()->comment('beginner|intermediate|expert — optionnel');
            $table->timestamps();
            $table->unique(['etudiant_id', 'competence_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('etudiant_competence');
    }
};
