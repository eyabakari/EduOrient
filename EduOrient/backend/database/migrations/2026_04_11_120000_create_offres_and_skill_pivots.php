<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('offres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recruteur_id')->constrained('recruteurs')->cascadeOnDelete();
            $table->string('titre');
            $table->text('description')->nullable();
            $table->string('type', 32)->default('stage');
            $table->string('lieu')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('offre_competence', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offre_id')->constrained('offres')->cascadeOnDelete();
            $table->foreignId('competence_id')->constrained('competences')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['offre_id', 'competence_id']);
        });

        Schema::create('recruteur_competence', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recruteur_id')->constrained('recruteurs')->cascadeOnDelete();
            $table->foreignId('competence_id')->constrained('competences')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['recruteur_id', 'competence_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recruteur_competence');
        Schema::dropIfExists('offre_competence');
        Schema::dropIfExists('offres');
    }
};
