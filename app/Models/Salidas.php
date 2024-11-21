<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salidas extends Model
{
    use HasFactory;

    protected $table = 'salidas'; 
    protected $fillable = [
        'id_usuario',
        'fecha',
        'hora_salida',
        'dia'
    ];
}