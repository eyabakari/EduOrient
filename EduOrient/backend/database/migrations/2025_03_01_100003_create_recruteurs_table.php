<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Profil Recruteur — héritage UML : id = users.id (PK/FK).
 * Données société intégrées (plus de table companies).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recruteurs', function (Blueprint $table) {
            $table->foreignId('id')->primary()->constrained('users')->cascadeOnDelete();
            $table->string('entreprise')->nullable();
            $table->string('poste')->nullable();
            $table->string('site_web', 500)->nullable();
            $table->string('ville', 120)->nullable();
            $table->string('gouvernorat', 120)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recruteurs');
    }
};
