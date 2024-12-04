<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Emails\credencialesController;
use App\Http\Controllers\GlobalController;
use App\Models\Alumnos;
use App\Models\Carrera_usuarios;
use App\Models\Credenciales1;
use App\Models\Usuarios;
use Illuminate\Http\Request;

class AdminAlumnosController extends Controller
{
    public function adminNuevoAlumno(Request $request){

        $id = $request->session()->get('id');
        $rol = $request->session()->get('rol');
        $ruta = $request->session()->get('ruta');

        $admin = Usuarios::find($id);

        return view('administradores.alumnos.nuevoAlumno',compact('admin'));
    }


    //trabajando aqui ------------------------
    public function nuevoAlumno(Request $request){

        $id = $request->session()->get('id');
        $admin = Usuarios::find($id);
        $alumnos = Alumnos::where('id', 'like', '%'.$request->input('search').'%')->paginate(4);

        $GlobalController = new GlobalController();
        //$EmailsController = new EmailsController();
        //$correo = $EmailsController->correo();
        $carrera = $request->input('carreras');
        $noCuenta = $request->input('numeroCuenta');
        $nombre = $request->input('nombres');
        $paterno = $request->input('apellidoPaterno');
        $materno = $request->input('apellidoMaterno');
        $correo = $request->input('correo');
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

        foreach($carreras as $nombreCarrera => $idCarrera){

            if(strpos($nombreCarrera, $carrera) !== false){
                $match = (int)$idCarrera;
                break;
            }
        }
        //cuenta
        if($GlobalController->validarCuenta($noCuenta ,0) == true){
            return back()->with('status', 'El numero de cuenta ya se encuentra registrado')->with('error',false)->withInput();
        }
        if($GlobalController->tamanioCuenta($noCuenta) == true){
            return back()->with('status', 'El numero de cuenta no cumple con el formato adecuado')->with('error',false)->withInput();
        }   
        //validar correo
        if($GlobalController->validarCorreo($correo) == true){
            return back()->with('status', 'El correo '.$correo. ' ya se encuentra registrado')->with('error',false)->withInput();
        }
        //numero de telefono 
        if($GlobalController->buscarNumero($telefono, 0) == true){
            return back()->with('status', 'El numero de telefono ya se encuentra registrado')->with('error',false)->withInput();
        }        
        //mensajes para los campos 
        $mensajeNombre = $GlobalController->validacionesTextos($nombre, "Nombre");
        $mensajePaterno = $GlobalController->validacionesTextos($paterno, "Apellido Paterno");
        $mensajeMaterno = $GlobalController->validacionesTextos($materno, "Apellido Materno");
        $mensajeTelefono = $GlobalController->validarNumero($telefono);

        if(!$mensajeNombre == ""){
            return back()->with('status', $mensajeNombre)->with('error',false)->withInput();
        }

        if(!$mensajePaterno == ""){
            return back()->with('status', $mensajePaterno)->with('error',false)->withInput();
        }

        if(!$mensajeMaterno == ""){
            return back()->with('status', $mensajeMaterno)->with('error',false)->withInput();
        }

        if(!$mensajeTelefono == ""){
            return back()->with('status', $mensajeTelefono)->with('error',false)->withInput();
        }

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

        return redirect('admin-consulta-alumnos')->with('status','Alumno creado exitosamente. !Se ha enviando un correo con los datos de inicio de sesión!')->with('error',true);
    }


    public function actualizarEstatus(Request $request, $id){
        
        $usuario = Usuarios::find($id);

        if ($usuario) {

            $usuario->estatus = $request->input('estatus');
            $usuario->save();

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'usuario no encontrado.']);
        }
    }


}