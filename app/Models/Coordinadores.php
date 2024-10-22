<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coordinadores extends Model
{
    use HasFactory;

    protected $table = 'vdepartamentos'; // Define el nombre de la tabla
    protected $fillable = [
        'id_usuario',
        'id_departamento',
        'no_cuenta',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'nombre_departamento',
        'carrera',
        'estatus'
    ];
}
