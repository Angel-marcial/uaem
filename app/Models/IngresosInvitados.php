<?php

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