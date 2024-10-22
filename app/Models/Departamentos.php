<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamentos extends Model
{
    use HasFactory;

    protected $table = 'departamentos'; // Define el nombre de la tabla
    protected $fillable = [
        'id',
        'id_usuario',
        'nombre_departamento',
        'edificio',
        'aula'
    ];
}