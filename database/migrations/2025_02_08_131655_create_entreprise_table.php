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
        Schema::create('entreprises', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->text('description');
            $table->string('adresse');
            $table->string('telephone');
            $table->string('email');
            $table->string('site_web');
            $table->string('reseaux_sociaux');
            $table->string('photo');
            $table->text('presentation');
            $table->text('services');
            $table->foreignId('id_categorie')->constrained('categories')->onDelete('cascade'); // Clé étrangère vers la table categories
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entreprises');
    }
};
