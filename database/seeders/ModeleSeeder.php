<?php

namespace Database\Seeders;

use App\Models\Marque;
use App\Models\Modele;
use Illuminate\Database\Seeder;

class ModeleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modele = Modele::create([
            'nom_modele' => 'vithz'
        ]);

        $marque = Marque::create(['nom_marque' => 'Toyota']);

        $modele->assignRole([$marque->id]);
    }
}
