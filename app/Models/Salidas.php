<?php
/*
*Codice
*Nombre del Código: Salidas.php
*Fecha de Creación: 18/09/2024 revisado por Angel Geovanni Marcial Morales
*
*Modificaciones:
*
*Descripción: Este archivo PHP cuenta con los campos que tendra la tabla salidas en la base de datos.  
*/
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salidas extends Model
{
    use HasFactory;

    protected $table = 'salidas'; 
    protected $fillable = [
        'id_usuario',
        'fecha',
        'hora_salida',
        'dia'
    ];
}