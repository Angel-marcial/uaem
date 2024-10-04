<?php

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

