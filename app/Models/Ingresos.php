<?php

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