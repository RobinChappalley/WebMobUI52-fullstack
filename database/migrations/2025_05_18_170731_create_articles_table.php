<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // nom de l'article
            $table->string('type'); // caméra, objectif, lumière, micro, etc.
            $table->string('brand')->nullable(); // marque (optionnel)
            $table->enum('state', ['disponible', 'emprunté'])->default('disponible');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
