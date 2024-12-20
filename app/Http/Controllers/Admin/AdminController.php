<?php
/* 
*
*Codice
*Nombre del Código: AdminController.php
*Fecha de Creación: 15/08/2024 
Revisado por: José Ángel Monsalvo Cruz
*
*Modificaciones:
*
*Descripción: Este archivo PHP cuenta con las operaciones para Alumnos desde Administrador
*/
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Alumnos\AlumnosController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\GlobalController;
use App\Models\Alumnos;
use App\Models\Credenciales1;
use App\Models\Ingresos;
use App\Models\IngresosInvitados;
use App\Models\Invitados;
use App\Models\Salidas;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Util\GlobalState;

class AdminController extends Controller
{
    //alumnos
    public function tablaAlumos(Request $request){

        $id = $request->session()->get('id');
        $rol = $request->session()->get('rol');
        $ruta = $request->session()->get('ruta');

        $admin = Usuarios::find($id);
        //$alumnos = Alumnos::get();
        $alumnos = Alumnos::where('id', 'like', '%'.$request->input('search').'%')->paginate(4);
        return view('administradores.alumnos.alumnos', compact('admin','alumnos'));
    }
    //buscar alumno
    public function buscarAlumos(Request $request){

        $id = $request->session()->get('id');
        $rol = $request->session()->get('rol');
        $ruta = $request->session()->get('ruta');
    
        $admin = Usuarios::find($id);
    
        // Obtén la consulta de búsqueda
        $search = $request->input('search');
    
        // Si hay un término de búsqueda, filtrar por él
        if ($search){

            $alumnos = Alumnos::where('no_cuenta', 'like', '%' . $search . '%')
                ->orWhere('nombre', 'like', '%' . $search . '%')
                ->orWhere('apellido_paterno', 'like', '%' . $search . '%')
                ->paginate(4); // Paginación con 10 alumnos por página
        } else {
            $alumnos = Alumnos::paginate(4); // Paginación con 10 alumnos por página si no hay búsqueda
        }
        if ($request->ajax()){
            return response()->json($alumnos);
        }
    
        return view('administradores.alumnos.alumnos', compact('admin', 'alumnos'));
    }
    //eliminar alumno
    public function eliminarAlumno(Request $request, $cuenta)
    {
        // Buscar al alumno por número de cuenta
        $alumno = Usuarios::where('no_cuenta', $cuenta)->first();
    
        if (!$alumno) {
            return redirect()->back()->with('status', 'El alumno no fue encontrado.')->with('error', false);
        }
    
        // Eliminar registros relacionados en las tablas 'ingresos' y 'salidas'
        DB::table('ingresos')->where('id_usuario', $alumno->id)->delete();
        DB::table('salidas')->where('id_usuario', $alumno->id)->delete();
    
        // Finalmente, eliminar al usuario
        $alumno->delete();
    
        return redirect()->back()->with('status', 'Alumno eliminado correctamente.')->with('success', true);
    }
    

    //editar alumno
    public function datosAlumno(Request $request, $cuenta){
        $id = $request->session()->get('id');

        $admin = Usuarios::find($id);
        $alumno = Alumnos::where('no_cuenta', $cuenta)->first();
        return view('administradores.alumnos.editarAlumno', compact('admin', 'alumno'));
    }

    //administrador
    public function consultaAdmin(Request $request){

        $id = $request->session()->get('id');
        $rol = $request->session()->get('rol');
        $ruta = $request->session()->get('ruta');

        if($rol == 'administrador'){
            //$alumnos = Alumno::with('credenciales')->get(); 
            $admin = Usuarios::find($id);
            $adminCredencial = Credenciales1::find($id);
            return view('administradores.indexAdministrador', compact('admin', 'adminCredencial'));
        }
        else if($rol !== 'administrador'){
            return redirect($ruta);
        } else {
            return redirect('index');
        }
    }

    public function editarAdmin(Request $request, $id){
        //campos de entrada
        $nombre = $request->input('nombres');
        $paterno = $request->input('apellidoPaterno');
        $materno = $request->input('apellidoMaterno');
        $telefono = $request->input('telefono'); 
        $correo = $request->input('correo');
        $password = $request->input('password');
        //mensaje para los errores de los campos de texto 
        $alumnosController = new AlumnosController();
        $globalController = new GlobalController();
        $mensajeNombre = $alumnosController->validacionesTextos($nombre, "Nombre");
        $mensajePaterno = $alumnosController->validacionesTextos($paterno, "Apellido Paterno");
        $mensajeMaterno = $alumnosController->validacionesTextos($materno, "Apellido Materno");
        $mensajeTelefono = $alumnosController->validarNumero($telefono);

        if(!$mensajeNombre == ""){
            return back()->with('status', $mensajeNombre);
        }

        if(!$mensajePaterno == ""){
            return back()->with('status', $mensajePaterno);
        }

        if(!$mensajeMaterno == ""){
            return back()->with('status', $mensajeMaterno);
        }

        if(!$mensajeTelefono == ""){
            return back()->with('status', $mensajeTelefono);
        }
 
        //Verificamos si el teléfono ya existen para otro usuario
        $usuarioDuplicado = Usuarios::where('telefono', $telefono)
        ->where('id', '!=', $id)
        ->first();

        if ($usuarioDuplicado){
            $mensaje = '';
            
            if ($usuarioDuplicado->telefono == $telefono) 
            {
                $mensaje .= 'El número de teléfono ' . $telefono . ' ya está registrado.';
            }

            return back()->with('status', $mensaje)
            ->with('error',false)->withInput();
        } else {
            Usuarios::where('id', $id)->update([
                'nombre' => $nombre,
                'apellido_paterno' => $paterno,
                'apellido_materno' => $materno,
                'telefono' => $telefono,
            ]);

            Credenciales1::where('id', $id)->update([
                'correo' => $correo,
                'password' => $password,
            ]);

            return redirect('/index-admin')->with('status', 'Datos actualizado exitosamente.')
            ->with('error',true)->withInput();
        }
    }

    public function dashboard(Request $request){

        date_default_timezone_set('America/Mexico_City');
        $date = date('Y-m-d');

        $id = $request->session()->get('id');
        $admin = Usuarios::find($id);


        // Consultar datos de la base de datos
        $data = [
            'labels' => ['Entrada', 'Salida', 'Invitados que ingresaron'], // Etiquetas
            'barData' => [   
                Ingresos::where('fecha', $date)->count(), //total de ingresos
                Salidas::where('fecha', $date)->count(), //total de salidas
                IngresosInvitados::where('fecha_ingreso', $date)->count(), //invitados que han ingresado.      
                Invitados::where('fecha_visita', $date)->count(), // invitados para el dia     
            ],
            'pieData' => [   // Datos para la gráfica de pastel 
                Ingresos::where('fecha', $date)->count(),
                Salidas::where('fecha', $date)->count(),
                IngresosInvitados::where('fecha_ingreso', $date)->count(),
            ],
        ];

        return view('administradores.dashboard.dashboard', compact('admin','data'));
    }

}