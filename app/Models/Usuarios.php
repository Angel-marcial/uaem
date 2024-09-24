<?php
/*
*Codice
*Nombre del Código: Usuarios.php
*Fecha de Creación: 29/09/2024 revisado por Angel Geovanni Marcial Morales
*
*Modificaciones:
*
*Descripción: Este archivo PHP cuenta con los campos que tendra la tabla usuarios en la base de datos.  
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    use HasFactory;

    protected $table = 'usuarios'; // Define el nombre de la tabla
    protected $fillable = [
        'no_cuenta',
        'nombre',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'telefono',
        'estatus',
    ];
}
