<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peticiones extends Model
{
    use HasFactory;

    protected $table = 'peticiones'; // Define el nombre de la tabla
    protected $fillable = [
        'nombre_invitado',
        'correo_invitado',
        'telefono',
        'hora_visita',
        'fecha_visita',
        'motivo',
        'estatus',
        'id_cordinador',
        'nombre_departamento',
        'edificio',
        'aula',
    ];
}