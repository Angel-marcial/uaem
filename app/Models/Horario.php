<?php
/*
*Codice
*Nombre del Código: Horario.php
*Fecha de Creación: 18/09/2024 revisado por Angel Geovanni Marcial Morales
*
*Modificaciones:
*
*Descripción: Este archivo PHP cuenta con los campos que tendra la tabla horario en la base de datos.  
*/
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $table = 'horario'; // Define el nombre de la tabla
    protected $fillable = [
        'id_usuario',
        'entrada_lunes',
        'salida_lunes',
        'entrada_martes',
        'salida_martes',
        'entrada_miercoles',
        'salida_miercoles',
        'entrada_jueves',
        'salida_jueves',
        'entrada_viernes',
        'salida_viernes',
        'entrada_sabado',
        'salida_sabado',
    ];
}
