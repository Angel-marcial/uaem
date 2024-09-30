<?php

namespace App\Http\Controllers\Index;
use App\Http\Controllers\Controller;

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

}
