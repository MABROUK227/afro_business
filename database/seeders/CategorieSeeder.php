<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categorie;

class CategorieSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Logement',
            'Santé',
            'Restaurant',
            'Vos déplacements',
            'L’administratif',
            'Les associations',
            'Vos sujets juridiques',
            'Services à domicile',
            'Éducation',
            'Technologie',
            'Commerce',
            'Voyages',
            'Culture et loisirs',
            'Finance',
            'Artisanat'
        ];

        foreach ($categories as $categorie) {
            Categorie::create(['libelle' => $categorie]);
        }
    }
}
