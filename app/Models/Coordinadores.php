<?php
/*
*Codice
*Nombre del Código: Coordinadores.php
*Fecha de Creación: 18/09/2024 revisado por Angel Geovanni Marcial Morales
*
*Modificaciones:
*
*Descripción: Este archivo PHP cuenta con los campos que tendra la tabla coordinadores en la base de datos.  
*/
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
        'edificio',
        'aula',
        'correo',
        'estatus'
    ];
}
