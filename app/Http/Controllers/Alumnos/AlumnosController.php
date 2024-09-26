<?php

namespace App\Http\Controllers\Alumnos;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Emails\credencialesController;
use App\Http\Controllers\Emails\EmailsController;
use Illuminate\Http\Request;
use App\Models\Credenciales1;
use App\Models\Carrera_usuarios;
use App\Models\Usuarios;

use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\password;
use function Laravel\Prompts\select;

class AlumnosController extends Controller
{
    
    public function guardarAlumnos(Request $request)
    {
        $EmailsController = new EmailsController();
        $correo = $EmailsController->correo();
        $carrera = $request->input('carreras');
        $nombre = $request->input('nombres');
        $noCuenta = $request->input('numeroCuenta');
        $telefono = $request->input('telefono');

        $carreras = [
            'ingenieria-software' => 1,
            'ingenieria-industrial' => 2,
            'ingenieria-plasticos' => 3,
            'ingenieria-sistemas' => 4,
            'ingenieria-mecanica' => 5,
            'seguridad-ciudadana' => 6,
        ];

        $match = null;

        foreach($carreras as $nombreCarrera => $idCarrera)
        {
            if(strpos($nombreCarrera, $carrera) !== false)
            {
                $match = (int)$idCarrera;
                break;
            }
        }

        $usuarioExistente = Usuarios::where('no_cuenta', $noCuenta)->orWhere('telefono', $telefono)->first();

        if ($usuarioExistente) 
        {
            $mensaje = '';
    
            if ($usuarioExistente->no_cuenta == $noCuenta) {
                $mensaje .= 'El número de cuenta ' . $noCuenta . ' ya está registrado. ';
            }
    
            if ($usuarioExistente->telefono == $telefono) {
                $mensaje .= 'El número de teléfono ' . $telefono . ' ya está registrado.';
            }
    
            return back()->with('status', $mensaje)->with('correoEnviado', false)->withInput();
        }

        Usuarios::create([
            'no_cuenta' => $request->input('numeroCuenta'),
            'nombre' => $request->input('nombres'),
            'apellido_paterno' => $request->input('apellidoPaterno'),
            'apellido_materno'=> $request->input('apellidoMaterno'),
            'telefono' => $request->input('telefono'),
            'estatus' => true,
        ]);

        $usuario = DB::table('usuarios')->where('no_cuenta', $request->input('numeroCuenta'))->value('id');

        Carrera_usuarios::create([
            'id_usuario' => $usuario,
            'id_carrera' => $match,
        ]);
        
        $credencialesController = new credencialesController();
        $password = $credencialesController->generarPassword();
        $credencialesController -> enviarCredencialesAlumno($nombre,$correo,$password);

        Credenciales1::create([
            'id_usuario' => $usuario,
            'correo' => $correo,
            'password' => $password,
            'rol' => 'alumno',
        ]);

        return redirect('/index')->with('status', 'Alumno creado exitosamente. !Se ha enviando un correo con los datos de inicio de sesión!');
    }
}
