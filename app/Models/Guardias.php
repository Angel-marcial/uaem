<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guardias extends Model
{
    use HasFactory;

    protected $table = 'guardias'; 
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