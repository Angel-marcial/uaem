<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maestros extends Model
{
    use HasFactory;

    protected $table = 'maestros'; 
    protected $fillable = [
        'id',
        'no_cuenta',
        'nombre',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'telefono',
        'carrera',
        'estatus'
    ];
}