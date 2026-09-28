<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Projets du portfolio étudiant (ex-projects / works).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('etudiant_id')->constrained('etudiants')->cascadeOnDelete();
            $table->string('titre');
            $table->text('description')->nullable();
            $table->string('lien_github', 500)->nullable();
            $table->string('lien_demo', 500)->nullable();
            $table->string('image', 500)->nullable();
            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projets');
    }
};
