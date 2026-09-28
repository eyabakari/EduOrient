<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Catalogue des compétences (ex-skills) + langues fusionnées via categorie.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('competences', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('categorie')->nullable()->comment('Technique | Langue | …');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('competences');
    }
};
