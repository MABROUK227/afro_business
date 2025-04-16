<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('libelle')->unique();
            $table->timestamps();
        });

        $categories = [
            'Artisanat', 'Commerce', 'Culture et loisirs', 'Déplacements',
            'Éducation', 'Finance', 'Juridiques', 'L’administratif',
            'Les associations', 'Logement', 'Restaurant', 'Santé',
            'Services ménagers', 'Technologie', 'Voyages'
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'libelle' => $category,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
