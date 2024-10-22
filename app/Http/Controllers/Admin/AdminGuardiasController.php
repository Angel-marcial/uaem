<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Emails\credencialesController;
use App\Http\Controllers\GlobalController;
use App\Mail\Credenciales;
use App\Models\Credenciales1;
use App\Models\Guardias;
use App\Models\Usuarios;
use Illuminate\Http\Request;

class AdminGuardiasController extends Controller
{
    public function adminNuevoGuardia(Request $request)
    {
        $id = $request->session()->get('id');
        $rol = $request->session()->get('rol');
        $ruta = $request->session()->get('ruta');

        $admin = Usuarios::find($id);

        return view('administradores.guardias.nuevoGuardia',compact('admin'));
    }
    //alumnos
    public function tablaGuardias(Request $request)
    {
        $id = $request->session()->get('id');
        $rol = $request->session()->get('rol');
        $ruta = $request->session()->get('ruta');

        $admin = Usuarios::find($id);
        $guardias = Guardias::where('id', 'like', '%'.$request->input('search').'%')->paginate(4);
        return view('administradores.guardias.guardias', compact('admin','guardias'));
    }
    //buscar alumno
    public function buscarGuardias(Request $request)
    {
        $id = $request->session()->get('id');
        $rol = $request->session()->get('rol');
        $ruta = $request->session()->get('ruta');

        $admin = Usuarios::find($id);

        // Obtén la consulta de búsqueda
        $search = $request->input('search');

        // Si hay un término de búsqueda, filtrar por él
        if ($search) 
        {
            $guardias = Guardias::where('no_cuenta', 'like', '%' . $search . '%')
                ->orWhere('nombre', 'like', '%' . $search . '%')
                ->orWhere('apellido_paterno', 'like', '%' . $search . '%')
                ->paginate(4); // Paginación con 10 alumnos por página
        } 
        else 
        {
            $guardias = Guardias::paginate(4); // Paginación con 10 alumnos por página si no hay búsqueda
        }
        if ($request->ajax()) 
        {
            return response()->json($guardias);
        }

        return view('administradores.guardias.guardias', compact('admin', 'guardias'));
    }
    //eliminar guardia
    public function eliminarGuardia(Request $request, $cuenta)
    {
        
        $guardia = Usuarios::where('no_cuenta', $cuenta)->first();

        // Verificar si el maestro existe
        if (!$guardia) {
            return redirect()->back()->with('status', 'El guardia no fue encontrado.')->with('error',false);
        }
        else
        {
            $guardia->delete();

            return redirect()->back()->with('status', 'guardia eliminado con exito.')->with('error',true);
        }
    }
    //editar guardia
    public function datosGuardia(Request $request, $cuenta)
    {
        $id = $request->session()->get('id');

        $admin = Usuarios::find($id);
        $guardia = Guardias::where('no_cuenta', $cuenta)->first();
        return view('administradores.guardias.editarGuardia', compact('admin', 'guardia'));
    }

    public function editarGuardia(Request $request, $id)
    {

        $GlobalController = new GlobalController();
        $cuenta = $request->input('numeroCuenta');
        $nombre = $request->input('nombres');
        $paterno = $request->input('apellidoPaterno');
        $materno = $request->input('apellidoMaterno');
        $telefono = $request->input('telefono');

        $mensajeNombre = $GlobalController->validacionesTextos($nombre, "Nombre");
        $mensajePaterno = $GlobalController->validacionesTextos($paterno, "Apellido Paterno");
        $mensajeMaterno = $GlobalController->validacionesTextos($materno, "Apellido Materno");
        $mensajeTelefono = $GlobalController->validarNumero($telefono);
        

        if($GlobalController->tamanioCuenta($cuenta) == true)
        {
            return back()->with('status', 'El numero de cuenta no cumple con el formato adecuado')->with('error',false)->withInput();
        }

        if($GlobalController->validarCuenta($cuenta, $id) == true)
        {
            return back()->with('status', 'El numero de cuenta ya se encuentra registrado')->with('error',false)->withInput();
        }

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

            Credenciales1::where()->update([


                
            ]);

            return redirect('/admin-consulta-alumnos')->with('status', 'Alumno actualizado con exito.')->with('error',true);
        }
 
    }


    //trabajando aqui ------------------------
    public function nuevoMaestro(Request $request)
    {
        $id = $request->session()->get('id');
        $admin = Usuarios::find($id);
        $guardias = Guardias::where('id', 'like', '%'.$request->input('search').'%')->paginate(4);

        $GlobalController = new GlobalController();
        //$EmailsController = new EmailsController();
        //$correo = $EmailsController->correo();
        $noCuenta = $request->input('numeroCuenta');
        $nombre = $request->input('nombres');
        $paterno = $request->input('apellidoPaterno');
        $materno = $request->input('apellidoMaterno');
        $correo = $request->input('correo');
        $telefono = $request->input('telefono');

        //cuenta
        if($GlobalController->validarCuenta($noCuenta ,0) == true)
        {
            return back()->with('status', 'El numero de cuenta ya se encuentra registrado')->with('error',false)->withInput();
        }
        if($GlobalController->tamanioCuenta($noCuenta) == true)
        {
            return back()->with('status', 'El numero de cuenta no cumple con el formato adecuado')->with('error',false)->withInput();
        }   
        //validar correo
        if($GlobalController->validarCorreo($correo) == true)
        {
            return back()->with('status', 'El correo '.$correo. ' ya se encuentra registrado')->with('error',false)->withInput();
        }
        //numero de telefono 
        if($GlobalController->buscarNumero($telefono, 0) == true)
        {
            return back()->with('status', 'El numero de telefono ya se encuentra registrado')->with('error',false)->withInput();
        }        
        //mensajes para los campos 
        $mensajeNombre = $GlobalController->validacionesTextos($nombre, "Nombre");
        $mensajePaterno = $GlobalController->validacionesTextos($paterno, "Apellido Paterno");
        $mensajeMaterno = $GlobalController->validacionesTextos($materno, "Apellido Materno");
        $mensajeTelefono = $GlobalController->validarNumero($telefono);

        if(!$mensajeNombre == "")
        {
            return back()->with('status', $mensajeNombre)->with('error',false)->withInput();
        }

        if(!$mensajePaterno == "")
        {
            return back()->with('status', $mensajePaterno)->with('error',false)->withInput();
        }

        if(!$mensajeMaterno == "")
        {
            return back()->with('status', $mensajeMaterno)->with('error',false)->withInput();
        }

        if(!$mensajeTelefono == "")
        {
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

        $credencialesController = new credencialesController();
        $password = $credencialesController->generarPassword();
        $credencialesController -> enviarCredencialesAlumno($nombre,$correo,$password);

        Credenciales1::create([
            'id_usuario' => $nuevoUsuario->id,
            'correo' => $correo,
            'password' => $password,
            'rol' => 'guardia',
        ]);

        return redirect('admin-consulta-guardias')->with('status','Guardia creado exitosamente. !Se ha enviando un correo con los datos de inicio de sesión!')->with('error',true);
    }



}

