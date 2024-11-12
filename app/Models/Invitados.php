<?php

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
