<?php
///hola mundo
namespace App\Http\Controllers\Index;
use App\Http\Controllers\Controller;
use App\Models\Departamentos;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class  IndexController extends Controller
{
    public function indexAlumnos()
    {
        session(['rol' => 'altaAlumno']);
        return view('alumnos.indexAlumnos');
    }

    public function indexMaestros()
    {
        return view('maestros.indexMaestros');
    } 
  
    public function IndexInvitados()
    {

        $departamentos = Departamentos::all();

        return view('invitados.indexInvitado', compact('departamentos'));
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
            $usuarioPermitido = Usuarios::where('id', $usuario->id_usuario)->first();

            if($usuarioPermitido->estatus == true)
            {
                if($usuario->rol == "guardia" )
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
                else if($usuario->rol == "cordinador")
                {
                    session(['id' => $usuario->id_usuario, 'rol' => $usuario->rol, 'ruta' => 'consulta-coordinadores']);
                    return redirect('consulta-coordinadores');
                }
            }
            else
            {
                return back()->with('status', 'No tienes acceso a tu cuenta. Contacta el departamento de administracion.')->with('error',false);
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
