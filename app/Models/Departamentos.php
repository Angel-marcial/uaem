<?php
/*
*Codice
*Nombre del Código: Departamentos.php
*Fecha de Creación: 18/09/2024 revisado por Angel Geovanni Marcial Morales
*
*Modificaciones:
*
*Descripción: Este archivo PHP cuenta con los campos que tendra la tabla departamentos en la base de datos.  
*/
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamentos extends Model
{
    use HasFactory;

    protected $table = 'departamentos'; // Define el nombre de la tabla
    protected $fillable = [
        'id',
        'id_usuario',
        'nombre_departamento',
        'edificio',
        'aula'
    ];
}