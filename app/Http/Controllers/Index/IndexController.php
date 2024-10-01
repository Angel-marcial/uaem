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

    public function login(Request $request)
    {
        $correo = $request->input('correo');
        $password = $request->input('contra');

        $usuario = DB::table('credenciales')
        ->where('correo', $correo)
        ->where('password', $password)
        ->select('id','rol')
        ->first();

        if($usuario)
        {
            if($usuario->rol == "guardia")
            {
                session(['id' => $usuario->id, 'rol' => $usuario->rol]);
                return redirect()->route('guardias.index')->with('success', 'Inicio de sesión exitoso.');
            }
            else
            {
                return redirect()->back()->with('error', 'Credenciales incorrectas.')->withInput();
            }
        }
        else
        {
            return redirect()->back()->with('error', 'Credenciales incorrectas.')->withInput();
        }
    }
    
    public function logout(Request $request)
    {
        // Elimina las variables específicas de la sesión
        $request->session()->flush();

        // Redirige al usuario a la página de inicio de sesión u otra página
        return redirect('index-maestros')->with('success', 'Sesión cerrada exitosamente.');
    }




}
