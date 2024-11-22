<?php

namespace App\Http\Controllers\Coordinadores;
use App\Http\Controllers\Controller;
use App\Models\Coordinadores;
use App\Models\Invitados;
use App\Models\Usuarios;
use Illuminate\Http\Request;

class CoordinadoresController extends Controller
{
    public function consultaCoordinadores(Request $request)
    {
        $id = $request->session()->get('id');
        $rol = $request->session()->get('rol');
        $ruta = $request->session()->get('ruta');


        if($rol == 'cordinador')
        {   
            //$alumnos = Alumno::with('credenciales')->get(); 
            $cordinador = Coordinadores::where('id_usuario', $id)->first();
            $usuarios = Usuarios::where('id', $id)->first();


            return view('coordinadores.indexCoordinador', compact('cordinador', 'usuarios'));
        }
        else if($rol !== 'cordinador')
        {
            return redirect($ruta);
        }
        else
        {
            return redirect('index');
        }
    }


    public function consultaCordinadoresDatos(Request $request)
    {
        $id = $request->session()->get('id');
        $rol = $request->session()->get('rol');
        $ruta = $request->session()->get('ruta');

        $cordinador = Coordinadores::where('id_usuario', $id)->first();
        return view('coordinadores.indexCordinador', compact('cordinador'));

    }

    public function coordinadorVerPeticiones(Request $request)
    {
        $id = $request->session()->get('id');
        $rol = $request->session()->get('rol');
        $ruta = $request->session()->get('ruta');

        $cordinador = Coordinadores::where('id_usuario', $id)->first();
        $peticiones = Invitados::where('area_visita',$cordinador->id_departamento)->get();

        return view('coordinadores.peticiones',compact('cordinador', 'peticiones'));
    }







}