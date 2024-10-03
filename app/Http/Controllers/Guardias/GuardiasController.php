<?php

namespace App\Http\Controllers\Guardias;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GuardiasController extends Controller
{
    public function indexGuardias(Request $request)
    {
        $id = $request->session()->get('id');
        $rol = $request->session()->get('rol');
        $ruta = $request->session()->get('ruta');

        if($rol == 'guardia')
        {
            return view('guardias.indexGuardia');
        }
        else if($rol !== 'guardia')
        {
            return redirect($ruta);
        }
        else
        {
            return redirect('index');
        }
    }
}