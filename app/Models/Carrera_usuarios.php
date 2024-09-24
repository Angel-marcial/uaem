<?php
/*
*Codice
*Nombre del Código: Carrera_usuarios.php
*Fecha de Creación: 23/09/2024 revisado por Angel Geovanni Marcial Morales
*
*Modificaciones:
*
*Descripción: Este archivo PHP cuenta con los campos que tendra la tabla carreras_usuarios en la base de datos.  
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera_usuarios extends Model
{
    use HasFactory;

    protected $table = 'carreras_usuarios'; // Define el nombre de la tabla
    protected $fillable = [
        'id_usuario',
        'id_carrera',
    ];
}
