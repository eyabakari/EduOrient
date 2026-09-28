<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projet_competence', function (Blueprint $table) {
            $table->id();
            $table->foreignId('projet_id')->constrained('projets')->cascadeOnDelete();
            $table->foreignId('competence_id')->constrained('competences')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['projet_id', 'competence_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projet_competence');
    }
};
