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

        return view('coordinadores.horarios.horario', ['cordinadores' => $query_principal[0], 'cordinador' => $cordinador]);
    }

    public function editarHorarioC(Request $request)
    {
        $id = $request->session()->get('id');

        // Validación de los datos
        $request->validate([
            'entrada_lunes' => 'nullable|date_format:H:i:s',
            'salida_lunes' => 'nullable|date_format:H:i:s',
            'entrada_martes' => 'nullable|date_format:H:i:s',
            'salida_martes' => 'nullable|date_format:H:i:s',
            'entrada_miercoles' => 'nullable|date_format:H:i:s',
            'salida_miercoles' => 'nullable|date_format:H:i:s',
            'entrada_jueves' => 'nullable|date_format:H:i:s',
            'salida_jueves' => 'nullable|date_format:H:i:s',
            'entrada_viernes' => 'nullable|date_format:H:i:s',
            'salida_viernes' => 'nullable|date_format:H:i:s',
            'entrada_sabado' => 'nullable|date_format:H:i:s',
            'salida_sabado' => 'nullable|date_format:H:i:s',
        ]);

        // Crear un array con los datos a actualizar
        $datosActualizar = [];
        $dias = ['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado'];

        // Recorremos los días para verificar qué campos actualizar
        foreach ($dias as $dia) {
            $entrada = $request->input("entrada_$dia");
            $salida = $request->input("salida_$dia");

            if (!is_null($entrada)) {
                $datosActualizar["entrada_$dia"] = $entrada;
            }
            if (!is_null($salida)) {
                $datosActualizar["salida_$dia"] = $salida;
            }
        }

        // Si hay datos para actualizar, mostrar la consulta SQL simulada
        if (!empty($datosActualizar)) {
            // Construye la consulta manualmente para inspección
            $updateQuery = "UPDATE horario SET ";
            $setParts = [];
            foreach ($datosActualizar as $column => $value) {
                $setParts[] = "$column = '$value'";
            }
            $updateQuery .= implode(", ", $setParts);
            $updateQuery .= " WHERE id_usuario = $id";

            //dd([
            //   'generated_query' => $updateQuery,
            //   'datosActualizar' => $datosActualizar
            //]);
        }

        // Realiza la actualización después de depurar la consulta
        Horario::where('id_usuario', $id)->update($datosActualizar);

        // Redirige de nuevo con un mensaje de éxito
        return redirect()->back()->with('status', 'Horario actualizado exitosamente');
    }
    

    public function coordinadoresCuenta(Request $request)
    {
        $id = $request->session()->get('id');
        $rol = $request->session()->get('rol');
        $ruta = $request->session()->get('ruta');
        $cordinador = Coordinadores::where('id_usuario', $id)->first();

        //ejecutamos la consulta
        $query_principal = DB::select('
        SELECT a.id, a.no_cuenta, a.nombre, a.apellido_paterno, a.apellido_materno,
        a.telefono, b.correo, b.password
        FROM usuarios a
        INNER JOIN credenciales b ON a.id = b.id_usuario
        WHERE a.id = ?
        ', [$id]);

        //ASEGURAMOS QUE LA CONSULTA CUENTA CON INFORMACION
        if(empty($query_principal))
        {
            return redirect()->back()->withErrors('Usuario o credenciales no encontrado.');
        }

        return view('coordinadores.cuentas.cuenta', ['cordinadores' => $query_principal[0], 'cordinador' => $cordinador]);
    }

    public function editarCordinador(Request $request)
    {
        $id = $request->session()->get('id');

        // Validar los datos recibidos
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidoPaterno' => 'required|string|max:255',
            'apellidoMaterno' => 'required|string|max:255',
            'telefono' => 'required|numeric',
            'correo' => 'required|email|max:255',
        ]);

        
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
            ]);

        return redirect()->back()->with('status', 'Información actualizada correctamente');

    }

}