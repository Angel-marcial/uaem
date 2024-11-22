<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngresosInvitados extends Model
{
    use HasFactory;
    protected $table = 'registro_invitados'; // Define el nombre de la tabla
    protected $fillable = [
        
        'id',
        'id_invitado',
        'hora_ingreso',
        'hora_salida'
    ];
}
