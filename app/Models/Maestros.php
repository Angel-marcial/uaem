<?php
/*
*Codice
*Nombre del Código: Maestros.php
*Fecha de Creación: 18/09/2024 revisado por Angel Geovanni Marcial Morales
*
*Modificaciones:
*
*Descripción: Este archivo PHP cuenta con los campos que tendra la tabla maestros en la base de datos.  
*/
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maestros extends Model
{
    use HasFactory;

    protected $table = 'maestros'; 
    protected $fillable = [
        'id',
        'no_cuenta',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'telefono',
        'correo',
        'estatus'
    ];
}