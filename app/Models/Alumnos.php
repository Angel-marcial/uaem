<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumnos extends Model
{
    use HasFactory;

    protected $table = 'alumnos'; // Define el nombre de la tabla
    protected $fillable = [
        'id',
        'no_cuenta',
        'nombre',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'telefono',
        'carrera'
    ];
}