<?php

namespace App\Http\Controllers\Index;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class  IndexController extends Controller
{
    public function indexAlumnos()
    {
        return view('alumnos.indexAlumnos');
    }

    public function indexMaestros()
    {
        return view('maestros.indexMaestros');
    }
  
    public function IndexInvitados()
    {
        return view('invitados.indexInvitado');
    }

    public function IndexGuardias()
    {
        return view('guardias.indexGuardia');
    }

    public function login(Request $request)
    {
        $correo = $request->input('correo');
        $password = $request->input('contra');

        
        $usuario = DB::table('credenciales')->where('correo', $correo)->where('password', $password)->first();

    }



}
