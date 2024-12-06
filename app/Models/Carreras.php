<?php
/*
*Codice
*Nombre del Código: Carreras.php
*Fecha de Creación: 18/09/2024 revisado por Angel Geovanni Marcial Morales
*
*Modificaciones:
*
*Descripción: Este archivo PHP cuenta con los campos que tendra la tabla carreras en la base de datos.  
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carreras extends Model
{
    use HasFactory;

    protected $table = 'carreras'; // Define el nombre de la tabla
    protected $fillable = [
        'nombre',
    ];
}
