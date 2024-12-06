<?php
/*
*Codice
*Nombre del Código: Ingresos.php
*Fecha de Creación: 18/09/2024 revisado por Angel Geovanni Marcial Morales
*
*Modificaciones:
*
*Descripción: Este archivo PHP cuenta con los campos que tendra la tabla ingresos en la base de datos.  
*/
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingresos extends Model
{
    use HasFactory;

    protected $table = 'ingresos';
    protected $fillable = [
        'id_usuario',
        'fecha',
        'hora_ingreso',
        'dia'
    ];
}