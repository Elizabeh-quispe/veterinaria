<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropietarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('propietario')->insert([
            [
                'nombre' => 'Carlos',
                'apellido_p' => 'Fernández',
                'apellido_m' => 'Lopez',
                'id_direccion' => 1,
                'ci' => '1234567',
                'telefono' => '76543210',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'María',
                'apellido_p' => 'Gómez',
                'apellido_m' => 'Perez',
                'id_direccion' => 2,
                'ci' => '7654321',
                'telefono' => '71234567',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
