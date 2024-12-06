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
use App\Models\Credenciales1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiLoginController extends Controller
{
    public function login(Request $request)
    {
        $correo = $request->input('correo');
        $password = $request->input('password');

        $usuario = DB::table('credenciales')->where('correo', $correo) ->where('password', $password)->first();

        if ($usuario) 
        {
            $id_usuario = $usuario->id_usuario;
            $rol = $usuario->rol;

            switch ($rol)
            {
                case 'alumno':

                    $alumno = DB::table('alumnos')->where('id', $id_usuario)->first();
                    $datos = (array) $alumno;
                    $datos['user_type'] = $rol;
                    $datos['token'] = 'token';
                    $datos['message'] = 'este usuario es un alumno';
                    
                    return response()->json($datos, 200);

                case 'maestro':

                    $maestro = DB::table('maestros')->where('id', $id_usuario)->first();
                    $datos = (array) $maestro;
                    $datos['user_type'] = $rol;
                    $datos['token'] = 'token';
                    $datos['message'] = 'este usuario es un maestro';

                    return response()->json($datos, 200);

                case 'cordinador':

                    $coordinador = DB::table('vdepartamentos')->where('id_usuario', $id_usuario)->first();
                    $datos = (array) $coordinador;
                    $datos['user_type'] = $rol;
                    $datos['token'] = 'token';
                    $datos['message'] = 'este usuario es un cordinador';
                    
                    return response()->json($datos, 200);

                default:

                return response()->json(['mensaje' => 'Correo o Contraseña inconrrectos'], 401);     
            }
        } else {
            return response()->json(['mensaje' => 'Correo o Contraseña inconrrectos'], 401);   
        }
    }
}