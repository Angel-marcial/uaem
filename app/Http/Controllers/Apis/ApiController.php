<?php
/* 
*
*Codice
*Nombre del Código: ApiController.php
*Fecha de Creación: 15/08/2024 
Revisado por: José Ángel Monsalvo Cruz
*
*Modificaciones:
*
*Descripción: Este archivo PHP cuenta con las operaciones para manejo de informacion de las apis 
*/

namespace App\Http\Controllers\Apis;
use App\Http\Controllers\Controller;
use App\Models\Usuarios;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index()
    {
        // Obtén los usuarios desde la base de datos
        $usuarios = Usuarios::all();

        // Devuelve los datos en formato JSON
        return response()->json($usuarios);
    }
}

