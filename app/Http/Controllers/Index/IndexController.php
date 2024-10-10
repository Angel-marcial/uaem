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
        ->select('id_usuario','rol')
        ->first();

        if($usuario)
        {
            if($usuario->rol == "guardia")
            {
                session(['id' => $usuario->id_usuario, 'rol' => $usuario->rol, 'ruta' => 'index-guardia']);
                return redirect('index-guardia');
            }
            else if($usuario->rol == "alumno")
            {
                session(['id' => $usuario->id_usuario, 'rol' => $usuario->rol, 'ruta' => 'consulta-alumnos']);
                return redirect('consulta-alumnos');
            }
            else if($usuario->rol == "maestro")
            {
                session(['id' => $usuario->id_usuario, 'rol' => $usuario->rol, 'ruta' => 'consulta-maestros']);
                return redirect('consulta-maestros');
            }
            else if($usuario->rol == "administrador")
            {
                session(['id' => $usuario->id_usuario, 'rol' => $usuario->rol, 'ruta' => 'index-admim']);
                return redirect('index-admin');
            }

        }
        else
        {
            return redirect()->back()->with('status', 'Correo o Contraseña inconrrectos')->with('error',false);
        }
    }
    
    public function cerrarSession(Request $request)
    {
        // Elimina las variables específicas de la sesión
        $request->session()->flush();

        // Redirige al usuario a la página de inicio de sesión u otra página
        return redirect('index')->with('success', 'Sesión cerrada exitosamente.');
    }




}
