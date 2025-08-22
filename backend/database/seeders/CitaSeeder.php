<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CitaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         DB::table('cita')->insert([
            [
                'id_mascota' => 1,
                'fecha' => '2025-08-10',
                'hora' => '10:00:00',
                'id_servicio' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_mascota' => 2,
                'fecha' => '2025-08-11',
                'hora' => '15:30:00',
                'id_servicio' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
