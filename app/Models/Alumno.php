<?php
/*
*Codice
*Nombre del Código: Alumno.blade.php
*Fecha de Creación: 29/09/2024 revisado por Angel Geovanni Marcial Morales
*
*Modificaciones:
*
*Descripción: Este archivo PHP cuenta con los campos que tendra la tabla alumnos en la base de datos.  
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    protected $table = 'alumnos'; // Define el nombre de la tabla
    protected $fillable = [
        'carrera_id',
        'cuenta',
        'nombre',
        'paterno',
        'materno',
        'correo',
        'telefono'
    ];
}
