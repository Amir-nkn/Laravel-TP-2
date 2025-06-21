<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VilleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $villes = ['Montréal', 'Laval', 'Québec', 'Trois-Rivières', 'Gatineau', 'Longueuil', 'Sherbrooke', 'Saguenay', 'Drummondville', 'Granby', 'Blainville', 'Terrebonne', 'Brossard', 'Saint-Jérôme', 'Repentigny'];

        foreach ($villes as $ville) {
            DB::table('villes')->insert([
                'nom' => $ville,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
