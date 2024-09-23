<?php

namespace App\Http\Controllers\Alumnos;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Emails\credencialesController;
use App\Http\Controllers\Emails\EmailsController;
use Illuminate\Http\Request;
use App\Models\Alumno;
use Google\Cloud\Storage\Connection\Rest;

class AlumnosController extends Controller
{
    
    public function guardarAlumnos(Request $request)
    {
        $EmailsController = new EmailsController();
        $correo = $EmailsController->correo();
        $carrera = $request->input('carreras');
        $nombre = $request->input('nombres');
        
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
                $match = $idCarrera;
                break;
            }
        }

        Alumno::create([
            'id_carrera' => $match,
            'cuenta' => $request->input('numeroCuenta'),
            'nombre' => $request->input('nombres'),
            'paterno' => $request->input('apellidoPaterno'),
            'materno' => $request->input('apellidoMaterno'),
            'telefono' => $request->input('telefono'),
        ]);

        $credencialesController = new credencialesController();
        $password = $credencialesController->generarPassword();
        $credencialesController -> enviarCredencialesAlumno($nombre,$correo,$password);



        return redirect('/index')->with('status', 'Alumno creado exitosamente. !Se ha enviando un correo con los datos de inicio de sesión!');
    }


    public function store(Request $request)
    {
        $carrera = $request->input('carreras');
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
                $match = $idCarrera;
                break;
            }
        }

        Alumno::create([
            'carrera_id' => $match,
            'cuenta' => $request->input('numeroCuenta'),
            'nombre' => $request->input('nombres'),
            'paterno' => $request->input('apellidoPaterno'),
            'materno' => $request->input('apellidoMaterno'),
            'telefono' => $request->input('telefono'),
        ]);


     
        /*
        // Validar los datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|max:255',
        ]);

        // Crear un nuevo alumno
        Alumno::create([
            'nombre' => $request->input('nombre'),
            'edad' => $request->input('edad'),
            'correo' => $request->input('correo'),
        ]);
        */

        // Redirigir con un mensaje de éxito
        return redirect('/')->with('success', 'Alumno creado exitosamente.');
    }

}
