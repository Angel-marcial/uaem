<?php

namespace App\Http\Controllers\Alumnos;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Emails\credencialesController;
use App\Http\Controllers\Emails\EmailsController;
use App\Http\Controllers\GlobalController;
use App\Models\Alumnos;
use Illuminate\Http\Request;
use App\Models\Credenciales1;
use App\Models\Carrera_usuarios;
use App\Models\Usuarios;

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
        else
        {
            $nuevoUsuario = Usuarios::create([
                'no_cuenta' => $request->input('numeroCuenta'),
                'nombre' => $request->input('nombres'),
                'apellido_paterno' => $request->input('apellidoPaterno'),
                'apellido_materno'=> $request->input('apellidoMaterno'),
                'telefono' => $request->input('telefono'),
                'estatus' => true,
            ]);
    
            //$usuario = DB::table('usuarios')->where('no_cuenta', $request->input('numeroCuenta'))->value('id');
    
            Carrera_usuarios::create([
                'id_usuario' => $nuevoUsuario->id,
                'id_carrera' => $match,
            ]);
            
            $credencialesController = new credencialesController();
            $password = $credencialesController->generarPassword();
            $credencialesController -> enviarCredencialesAlumno($nombre,$correo,$password);
    
            Credenciales1::create([
                'id_usuario' => $nuevoUsuario->id,
                'correo' => $correo,
                'password' => $password,
                'rol' => 'alumno',
            ]);
    
            return redirect('/index')->with('status', 'Alumno creado exitosamente. !Se ha enviando un correo con los datos de inicio de sesión!');
        }
    }

    public function consultaAlumnos(Request $request)
    {
        $id = $request->session()->get('id');
        $rol = $request->session()->get('rol');
        $ruta = $request->session()->get('ruta');


        if($rol == 'alumno')
        {
            //$alumnos = Alumno::with('credenciales')->get(); 

            $alumno = Alumnos::find($id);
            return view('alumnos.consulta', compact('alumno'));
        }
        else if($rol !== 'alumno')
        {
            return redirect($ruta);
        }
        else
        {
            return redirect('index');
        }
    }

    function editarAlumno(Request $request, $id , $interfaz)
    {
        $GlobalController = new GlobalController();

        $nombre = $request->input('nombres');
        $paterno = $request->input('apellidoPaterno');
        $materno = $request->input('apellidoMaterno');
        $telefono = $request->input('telefono');

        //nombre
        $mensajeNombre = $this->validacionesTextos($nombre, "Nombre");
        $mensajePaterno = $this->validacionesTextos($paterno, "Apellido Paterno");
        $mensajeMaterno = $this->validacionesTextos($materno, "Apellido Materno");
        $mensajeTelefono = $this->validarNumero($telefono);
        
        if(!$mensajeNombre == "")
        {
            return back()->with('status', $mensajeNombre);
        }

        if(!$mensajePaterno == "")
        {
            return back()->with('status', $mensajePaterno);
        }

        if(!$mensajeMaterno == "")
        {
            return back()->with('status', $mensajeMaterno);
        }

        if(!$mensajeTelefono == "")
        {
            return back()->with('status', $mensajeTelefono);
        }

        $usuarioExistente = Usuarios::find($id);
    
        if (!$usuarioExistente) {
            return back()->with('status', 'No se puedo actializar los datos, contacta con soporte tecnico')
            ->with('error',false)->withInput();
        }
        
        //Verificamos si el teléfono ya existen para otro usuario
        $usuarioDuplicado = Usuarios::where('telefono', $telefono)
        ->where('id', '!=', $id)
        ->first();
    
        if ($usuarioDuplicado) {
            $mensaje = '';
            
            if ($usuarioDuplicado->telefono == $telefono) 
            {
                $mensaje .= 'El número de teléfono ' . $telefono . ' ya está registrado.';
            }
    
            return back()->with('status', $mensaje)
            ->with('error',false)->withInput();
        }else
        {
            
            if($interfaz == "admin")
            {
                $cuenta = $request->input('numeroCuenta');
                $carrera = $request->input('carreras');

                $carreras = [
                    'ingenieria-software' => 1,
                    'ingenieria-industrial' => 2,
                    'ingenieria-plasticos' => 3,
                    'ingenieria-sistemas' => 4,
                    'ingenieria-mecanica' => 5,
                    'seguridad-ciudadana' => 6,
                ];

                $match = $carreras[$carrera] ?? null;

                if($GlobalController->validarCuenta($cuenta, $id) !== null)
                {
                    return back()->with('status', 'El numero de cuenta ya se encuentra registrado')->with('error',false)->withInput();
                }
                if($GlobalController->tamanioCuenta($cuenta) == true)
                {
                    return back()->with('status', 'El numero de cuenta no cumple con el formato adecuado')->with('error',false)->withInput();
                }
                if($GlobalController->buscarNumero($telefono, $id) !==null)
                {
                    back()->with('status', 'El numero de telefono ya se encuentra registrado')->with('error',false)->withInput();
                }

                Usuarios::where('id', $id)->update([
                    'no_cuenta' => $cuenta,
                    'nombre' => $nombre,
                    'apellido_paterno' => $paterno,
                    'apellido_materno' => $materno,
                    'telefono' => $telefono,
                ]);

                Carrera_usuarios::where('id_usuario', $id)->update([
                    'id_carrera' => $match,
                ]);

               return redirect('/admin-consulta-alumnos')->with('status', 'Alumno actualizado con exito.')->with('error',true);
            }
            else
            {      
                Usuarios::where('id', $id)->update([
                    'nombre' => $nombre,
                    'apellido_paterno' => $paterno,
                    'apellido_materno' => $materno,
                    'telefono' => $telefono,
                ]);

                return redirect('/consulta-alumnos')->with('status', 'Datos actualizado exitosamente.')
                ->with('error',true)->withInput();
            }
        }
    }  


    public function validacionesTextos(string $texto, string $campo): string
    {
        $regexPalabra = '/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/';

        //El apellido materno solo puede contener letras
        if(empty($texto))
        {
            return "El campo " . $campo . " no puede estar vacio";
        }

        if(!preg_match($regexPalabra, $texto))
        {
            return "El " . $campo . " solo puede contener letras";
        }

        return "";
    }  
    
    public function validarNumero(string $numero): string
    {
        $cantidadDeDigitos = strlen((string)$numero);

        //"El número de teléfono debe tener exactamente 10 dígitos.";
        if(empty($numero))
        {
            return "Numero de telefono obligatorio";
        }

        if($cantidadDeDigitos !== 10)
        {
            return "El número de teléfono debe tener exactamente 10 dígitos.";
        }

        return "";
    }


    public function adminConsultaAlumnos()
    {

    }


}
