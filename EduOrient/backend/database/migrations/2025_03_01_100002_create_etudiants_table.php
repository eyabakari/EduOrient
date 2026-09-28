<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Profil Étudiant — héritage UML : id = users.id (PK/FK, pas de user_id séparé).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('etudiants', function (Blueprint $table) {
            $table->foreignId('id')->primary()->constrained('users')->cascadeOnDelete();
            $table->text('bio')->nullable();
            $table->string('niveau_etude')->nullable();
            $table->string('specialite')->nullable();
            $table->string('linkedin', 500)->nullable();
            $table->boolean('portfolio_public')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('etudiants');
    }
};
