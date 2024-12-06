<?php
/*
*Codice
*Nombre del Código: Invitados.php
*Fecha de Creación: 18/09/2024 revisado por Angel Geovanni Marcial Morales
*
*Modificaciones:
*
*Descripción: Este archivo PHP cuenta con los campos que tendra la tabla invitados en la base de datos.  
*/
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitados extends Model
{
    use HasFactory;

    protected $table = 'invitados'; 
    protected $fillable = [
        'id',
        'nombre_completo',
        'correo',
        'telefono',
        'area_visita',
        'hora_visita',
        'fecha_visita',
        'motivo',
        'estatus'
    ];
}
