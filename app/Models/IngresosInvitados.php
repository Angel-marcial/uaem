<?php
/*
*Codice
*Nombre del Código: IngresosInvitados.php
*Fecha de Creación: 18/09/2024 revisado por Angel Geovanni Marcial Morales
*
*Modificaciones:
*
*Descripción: Este archivo PHP cuenta con los campos que tendra la tabla registro_invitados en la base de datos.  
*/
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngresosInvitados extends Model
{
    use HasFactory;

    protected $table = 'registro_invitados';
    protected $fillable = [
        'id_invitado',
        'hora_ingreso',
        'hora_salida',
        'fecha_ingreso',
    ];
}