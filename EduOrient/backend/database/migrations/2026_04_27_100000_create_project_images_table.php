<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projet_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('projet_id')->constrained('projets')->cascadeOnDelete();
            $table->string('image_path', 500);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projet_images');
    }
};
