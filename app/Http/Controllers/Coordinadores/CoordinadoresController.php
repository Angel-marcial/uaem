<?php

namespace App\Http\Controllers\Coordinadores;
use App\Http\Controllers\Controller;
use App\Models\Coordinadores;
use App\Models\Invitados;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use App\Models\Horario;
use Illuminate\Support\Facades\DB;

class CoordinadoresController extends Controller
{
    public function consultaCoordinadores(Request $request)
    {
        $id = $request->session()->get('id');
        $rol = $request->session()->get('rol');
        $ruta = $request->session()->get('ruta');


        if($rol == 'cordinador')
        {   
            //$alumnos = Alumno::with('credenciales')->get(); 
            $cordinador = Coordinadores::where('id_usuario', $id)->first();
            $usuarios = Usuarios::where('id', $id)->first();


            return view('coordinadores.indexCoordinador', compact('cordinador', 'usuarios'));
        }
        else if($rol !== 'cordinador')
        {
            return redirect($ruta);
        }
        else
        {
            return redirect('index');
        }
    }


    public function consultaCordinadoresDatos(Request $request)
    {
        $id = $request->session()->get('id');
        $rol = $request->session()->get('rol');
        $ruta = $request->session()->get('ruta');

        $cordinador = Coordinadores::where('id_usuario', $id)->first();
        return view('coordinadores.indexCordinador', compact('cordinador'));

    }

    public function coordinadorVerPeticiones(Request $request)
    {
        $id = $request->session()->get('id');
        $rol = $request->session()->get('rol');
        $ruta = $request->session()->get('ruta');

        $cordinador = Coordinadores::where('id_usuario', $id)->first();
        $peticiones = Invitados::where('area_visita',$cordinador->id_departamento)->get();

        return view('coordinadores.peticiones',compact('cordinador', 'peticiones'));
    }

    public function coordinadoresRegistros(Request $request)
    {
        $id = $request->session()->get('id');
        $rol = $request->session()->get('rol');
        $ruta = $request->session()->get('ruta');

        // Validación de rol y redirección
        if ($rol !== 'cordinador') {
            return redirect($ruta ?? 'index');
        }

         // Obtener el maestro y su horario, en caso de ser necesario para la vista
        $cordinador = Usuarios::find($id);
        $horario = Horario::where('id_usuario', $id)->first();

        //obtenemos los parametros de busqueda
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

        return view('coordinadores.registros.registro', compact('cordinador', 'horario', 'query_principal', 'option', 'day', 'startDate', 'endDate'));
    }

    public function coordinadoresHorarios(Request $request)
    {
        $id = $request->session()->get('id');
        $rol = $request->session()->get('rol');
        $ruta = $request->session()->get('ruta');
        $cordinador = Coordinadores::where('id_usuario', $id)->first();

        $query_principal = DB::table('horario')
        ->join('usuarios', 'horario.id_usuario', '=', 'usuarios.id')
        ->select('horario.*', 'usuarios.nombre', 'usuarios.apellido_paterno')
        ->where('horario.id_usuario', $id)
        ->get();

        if (empty($query_principal)) {
            return redirect()->back()->withErrors('El Docente no cuenta con horarios.');
        }

            return view('coordinadores.horarios.horario', [
        'cordinadores' => $query_principal[0], // Primer registro del resultado de la consulta
        'cordinador' => $cordinador           // Información del coordinador
    ]);
    }

    public function coordinadoresCuenta(Request $request)
    {
        $id = $request->session()->get('id');
        $rol = $request->session()->get('rol');
        $ruta = $request->session()->get('ruta');

        return view('coordinadores.cuentas.cuenta');
    }

}