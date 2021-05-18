<?php

namespace Database\Seeders;

use App\Models\Marque;
use Illuminate\Database\Seeder;

class marqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $marque = Marque::create([
            'nom_marque' => 'Toyota'
        ]);
        Marque::create(['nom_marque' => $marque]);

    }
}
