<?php
/*
*Codice
*Nombre del Código: Peticiones.php
*Fecha de Creación: 18/09/2024 revisado por Angel Geovanni Marcial Morales
*
*Modificaciones:
*
*Descripción: Este archivo PHP cuenta con los campos que tendra la tabla peticiones en la base de datos.  
*/
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peticiones extends Model
{
    use HasFactory;

    protected $table = 'peticiones'; // Define el nombre de la tabla
    protected $fillable = [
        'nombre_invitado',
        'correo_invitado',
        'telefono',
        'hora_visita',
        'fecha_visita',
        'motivo',
        'estatus',
        'id_cordinador',
        'nombre_departamento',
        'edificio',
        'aula',
    ];
}