<?php
/*
*Codice
*Nombre del Código: Credenciales.php
*Fecha de Creación: 23/09/2024 revisado por Angel Geovanni Marcial Morales
*
*Modificaciones:
*
*Descripción: Este archivo PHP cuenta con los campos que tendra la tabla credenciales en la base de datos.  
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credenciales1 extends Model
{
    use HasFactory;

    protected $table = 'credenciales'; // Define el nombre de la tabla
    protected $fillable = [
        'id_usuario',
        'correo',
        'password',
        'rol'
    ];
}
