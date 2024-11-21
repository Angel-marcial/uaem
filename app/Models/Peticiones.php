<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peticiones extends Model
{
    use HasFactory;

    protected $table = 'peticionmes'; // Define el nombre de la tabla
    protected $fillable = [
        'nombre_completo',
        'correo_invitado',
        'telefono',
        'area_visita',
        'hora_visita',
        'fecha_visita',
        'motivo',
        'estatus',
        'id_usuario',
        'id_departamento',
        'no_cuenta',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'nombre_departamento',
        'edificio',
        'aula',
        'correo_admin',
    ];
}