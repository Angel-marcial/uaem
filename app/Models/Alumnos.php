<?php
/* 
*
*Codice
*Nombre del Código: Alumnos.php
*Fecha de Creación: 15/08/2024 
Revisado por: José Ángel Monsalvo Cruz
*
*Modificaciones:
*
*Descripción: Este archivo PHP cuenta con los campos que tendra la tabla alumnos en la base de datos. 
*/
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
        'carrera',
        'estatus'
    ];
}