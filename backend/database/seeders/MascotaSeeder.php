<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class MascotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('mascota')->insert([
            [
                'nom_mascota' => 'Braulio',
                'id_raza' => 1,
                'edad' => 3,
                'color' => 'Marrón',
                'id_propietario' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom_mascota' => 'Firulais',
                'id_raza' => 2,
                'edad' => 2,
                'color' => 'Blanco',
                'id_propietario' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
