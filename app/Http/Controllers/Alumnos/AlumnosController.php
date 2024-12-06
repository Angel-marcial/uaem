<?php
/* 
*
*Codice
*Nombre del Código: AlumnosController.php
*Fecha de Creación: 15/08/2024 
Revisado por: José Ángel Monsalvo Cruz
*
*Modificaciones:
*
*Descripción: Este archivo PHP cuenta con las operaciones para Alumnos 
*/

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
use App\Models\Horario;
use Illuminate\Support\Facades\DB;

class AlumnosController extends Controller
{

    public function guardarAlumnos(Request $request)
    {
        $EmailsController = new EmailsController();
        $GlobalController = new GlobalController();

        $correo = $EmailsController->correo();
        $carrera = $request->input('carreras');
        $nombre = $request->input('nombres');
        $paterno = $request->input('apellidoPaterno');
        $materno = $request->input('apellidoMaterno');
        $telefono = $request->input('telefono');
        $noCuenta = $request->input('numeroCuenta');
        $telefono = $request->input('telefono');

        $mensajeNombre = $this->validacionesTextos($nombre, "Nombre");
        $mensajePaterno = $this->validacionesTextos($paterno, "Apellido Paterno");
        $mensajeMaterno = $this->validacionesTextos($materno, "Apellido Materno");
        $mensajeTelefono = $this->validarNumero($telefono);

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

        if($GlobalController->tamanioCuenta($noCuenta) == true)
        {
            return back()->with('status', 'El numero de cuenta no cumple con el formato adecuado')
            ->with('codigoAprobado', true)
            ->with('correoEnviado',false)
            ->with('error',false)
            ->withInput();
        }

        if(!$mensajeNombre == "")
        {
            return back()->with('status', $mensajeNombre)
            ->with('codigoAprobado', true)
            ->with('correoEnviado',false)
            ->with('error',false)
            ->withInput();
        }

        if(!$mensajePaterno == "")
        {
            return back()->with('status', $mensajePaterno)
            ->with('codigoAprobado', true)
            ->with('correoEnviado',false)
            ->with('error',false)
            ->withInput();
        }

        if(!$mensajeMaterno == "")
        {
            return back()->with('status', $mensajeMaterno)
            ->with('codigoAprobado', true)
            ->with('correoEnviado',false)
            ->with('error',false)
            ->withInput();
        }

        if(!$mensajeTelefono == "")
        {
            return back()->with('status', $mensajeTelefono)
            ->with('codigoAprobado', true)
            ->with('correoEnviado',false)
            ->with('error',false)
            ->withInput();
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
    
            return back()->with('status', $mensaje)
            ->with('codigoAprobado', true)
            ->with('correoEnviado',false)
            ->with('error',false)
            ->withInput();
            
        } else {
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
    
            return redirect('/index')->with('status', 'Alumno creado exitosamente. !Se ha enviando un correo con los datos de inicio de sesión!')
            ->with('error', true);
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
        } else {
            return redirect('index');
        }
    }

    function editarAlumnos(Request $request, $id , $interfaz)
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
        } else {
            
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
            } else {      
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
        if(empty($texto)){
            return "El campo " . $campo . " no puede estar vacio";
        }

        if(!preg_match($regexPalabra, $texto)){
            return "El " . $campo . " solo puede contener letras";
        }

        return "";
    }  
    
    public function validarNumero(string $numero): string
    {
        $cantidadDeDigitos = strlen((string)$numero);

        //"El número de teléfono debe tener exactamente 10 dígitos.";
        if(empty($numero)){
            return "Numero de telefono obligatorio";
        }

        if($cantidadDeDigitos !== 10){
            return "El número de teléfono debe tener exactamente 10 dígitos.";
        }

        return "";
    }

    public function alumnosRegistros(Request $request)
    {
        $id = $request->session()->get('id');
        $rol = $request->session()->get('rol');
        $ruta = $request->session()->get('ruta');
 
        // Validación de rol y redirección
        if ($rol !== 'alumno') {
            return redirect($ruta ?? 'index');
        }

        // Obtener el maestro y su horario, en caso de ser necesario para la vista
        $alumno = Usuarios::find($id);
        $horario = Horario::where('id_usuario', $id)->first();

        // Obtener los parámetros de búsqueda
        $option = $request->input('option');
        $day = $request->input('day');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Consulta base para el maestro actual
        $query = DB::table('ingreso_salida')->where('id', $id);

        // Aplicar filtros según la opción seleccionada
        if ($option == '1' && $day) {
            // Filtro por día específico
            $query->whereDate('fecha', $day);
        } elseif ($option == '2' && $startDate && $endDate) {
            // Filtro por rango de fechas
            $query->whereBetween('fecha', [$startDate, $endDate]);
        }

        // Paginación de los resultados
        $query_principal = $query->paginate(5);
        return view('alumnos.registros.registro',compact('alumno', 'horario', 'query_principal', 'option', 'day', 'startDate', 'endDate'));
    }

    public function informacionAlumno(Request $request)
    {
        //obtenemos el id de la session 
        $id = $request->session()->get('id');
        $rol = $request->session()->get('rol');

        //ejecutamos la consulta
        $query_principal = DB::select('
        SELECT a.id, a.no_cuenta, a.nombre, a.apellido_paterno, a.apellido_materno,
        a.telefono, b.correo, b.password
        FROM usuarios a
        INNER JOIN credenciales b ON a.id = b.id_usuario
        WHERE a.id = ?
        ', [$id]);

         
        // Validación de rol y redirección
        if ($rol !== 'alumno') {
            return redirect($ruta ?? 'index');
        }

        //ASEGURAMOS QUE LA CONSULTA CUENTA CON INFORMACION
        if(empty($query_principal)){
            return redirect()->back()->withErrors('Usuario o credenciales no encontrado.');
        }

        //pasamos los datos a la vista 
        return view('alumnos.cuentas.cuenta', ['alumno' => $query_principal[0]]);
    }

    public function editarAlumno2(Request $request, $id)
    {
        $rol = $request->session()->get('rol');
        
        // Validar los datos recibidos
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidoPaterno' => 'required|string|max:255',
            'apellidoMaterno' => 'required|string|max:255',
            'telefono' => 'required|numeric',
            'correo' => 'required|email|max:255',
        ]);

        // Validación de rol y redirección
        if ($rol !== 'alumno') {
            return redirect($ruta ?? 'index');
        }
        // Actualizar los datos en la base de datos
        DB::table('usuarios')
            ->where('id', $id)
            ->update([
                'nombre' => $request->input('nombres'),
                'apellido_paterno' => $request->input('apellidoPaterno'),
                'apellido_materno' => $request->input('apellidoMaterno'),
                'telefono' => $request->input('telefono'),
            ]);

        DB::table('credenciales')
            ->where('id_usuario', $id)
            ->update([
                'correo' => $request->input('correo'),
                'password' => $request->input('password'),
            ]);

        return redirect()->back()->with('status', 'Información actualizada correctamente');
    }

}
