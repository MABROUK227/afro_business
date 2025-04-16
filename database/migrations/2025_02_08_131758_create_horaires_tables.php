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
        Schema::create('horaires', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_entreprise')->constrained('entreprises')->onDelete('cascade'); // Clé étrangère vers la table entreprises
            $table->string('jour'); // Jour de la semaine
            $table->string('ouverture'); // Heure d'ouverture
            $table->string('fermeture'); // Heure de fermeture
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('=horaires');
    }
};
