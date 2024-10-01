<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usuarios =[
            [
                'no_cuenta' => 1000001,
                'nombre' => 'Juan',
                'apellido_paterno' => 'Perez',
                'apellido_materno' => 'Lopez',
                'telefono' => 7221234567,
                'estatus' => true,
            ]
        ];

        foreach($usuarios as $usuario)
        {
            $usuarioId = DB::table('usuarios')->insertGetId($usuario);

            DB::table('credenciales')->insert([
                'id_usuario' => $usuarioId,
                'correo' => 'correoPrueba@gmail.com',
                'password' => '123RYU76Tf',
                'rol' => 'administrador'
            ]);

        }
    }
}
