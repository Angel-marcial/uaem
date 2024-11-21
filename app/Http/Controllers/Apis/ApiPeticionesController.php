<?php

namespace App\Http\Controllers\Apis;
use App\Http\Controllers\Controller;
use App\Models\Coordinadores;
use App\Models\Peticiones;
use App\Models\Usuarios;
use Illuminate\Http\Request;

class ApiPeticionesController extends Controller
{
    public function peticiones($id)
    {
        //$usuarios = Usuarios::all();

        $departamentoSolicitado = Peticiones::where('id_cordinador', $id)->get();


        return response()->json($departamentoSolicitado);
    }
}

