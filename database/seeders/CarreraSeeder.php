<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CarreraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insertar carreras iniciales en la tabla 'carreras'
        DB::table('carreras')->insert([
            ['nombre' => 'Ingeniería de Software'],
            ['nombre' => 'Ingeniería Industrial'],
            ['nombre' => 'Ingeniería de Plásticos'],
            ['nombre' => 'Ingeniería de Sistemas'],
            ['nombre' => 'Ingeniería Mecánica'],
            ['nombre' => 'Seguridad Ciudadana'],
        ]);
    }
}
