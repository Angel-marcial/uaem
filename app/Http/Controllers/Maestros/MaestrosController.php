<?php

namespace App\Http\Controllers\Maestros;

use App\Http\Controllers\Alumnos\AlumnosController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Emails\credencialesController;
use App\Http\Controllers\Emails\EmailsController;
use App\Models\Credenciales1;
use App\Models\Horario;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaestrosController extends Controller
{

    public function guardarMaestros(Request $request)
    {
        $EmailsController = new EmailsController();
        $correo = $EmailsController->correo();
        //datos del maestro
        $noCuenta = $request->input('numeroCuenta');
        $nombre = $request->input('nombres');
        $paterno = $request->input('apellidoPaterno');
        $materno = $request->input('apellidoMaterno');
        $telefono = $request->input('telefono');
        //lunes
        $entradaLunes = $request->input('entradaLunes');
        $salidaLunes = $request->input('salidaLunes');
        //martes
        $entradaMartes = $request->input('entradaMartes');
        $salidaMartes = $request->input('salidaMartes');
        //miercoles
        $entradaMiercoles = $request->input('entradaMiercoles');
        $salidaMiercoles = $request->input('salidaMiercoles');
        //jueves
        $entradaJueves = $request->input('entradaJueves');
        $salidaJueves = $request->input('salidaJueves');
        //viernes
        $entradaViernes = $request->input('entradaViernes');
        $salidaViernes = $request->input('salidaViernes');
        //sabado
        $entradaSabado = $request->input('entradaSabado');
        $salidaSabado = $request->input('salidaSabado');

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
            ->with('correoEnviado', false)
            ->with('codigoAprobado', true)
            ->with('error', true)
            ->withInput();
        }
        else
        {

            //lunes
            $lunesMensaje = $this->validarHoras($entradaLunes,$salidaLunes);
            // Martes
            $martesMensaje = $this->validarHoras($entradaMartes, $salidaMartes);
            // Miércoles
            $miercolesMensaje = $this->validarHoras($entradaMiercoles, $salidaMiercoles);
            // Jueves
            $juevesMensaje = $this->validarHoras($entradaJueves, $salidaJueves);
            // Viernes
            $viernesMensaje = $this->validarHoras($entradaViernes, $salidaViernes);
            // Sábado
            $sabadoMensaje = $this->validarHoras($entradaSabado, $salidaSabado);

            //lunes 
            if($lunesMensaje === "vacio")
            {

            }
            else if($lunesMensaje != "") 
            {
                return back()->with('status', 'Lunes: ' . $lunesMensaje)
                ->with('correoEnviado', false)
                ->with('codigoAprobado', true)
                ->with('error', true)
                ->withInput();
            }
            //martes 
            if($martesMensaje === "vacio")
            {

            }
            else if($martesMensaje != "") 
            {
                return back()->with('status', 'Martes: ' . $martesMensaje)
                ->with('correoEnviado', false)
                ->with('codigoAprobado', true)
                ->with('error', true)
                ->withInput();
            }
            //miercoles
            if($miercolesMensaje === "vacio")
            {

            }
            else if($miercolesMensaje != "") 
            {
                return back()->with('status', 'Miercoles: ' . $miercolesMensaje)
                ->with('correoEnviado', false)
                ->with('codigoAprobado', true)
                ->with('error', true)
                ->withInput();
            }
            //jueves 
            if($juevesMensaje === "vacio")
            {

            }
            else if($juevesMensaje != "") 
            {
                return back()->with('status', 'Jueves: ' . $juevesMensaje)
                ->with('correoEnviado', false)
                ->with('codigoAprobado', true)
                ->with('error', true)
                ->withInput();
            }
            //viernes
            if($viernesMensaje === "vacio")
            {

            }
            else if($viernesMensaje != "") 
            {
                return back()->with('status', 'Viernes: ' . $viernesMensaje)
                ->with('correoEnviado', false)
                ->with('codigoAprobado', true)
                ->with('error', true)
                ->withInput();
            }
            //sabado
            if($sabadoMensaje === "vacio")
            {

            }
            else if($sabadoMensaje != "") 
            {
                return back()->with('status', 'Sabado: ' . $sabadoMensaje)
                ->with('correoEnviado', false)
                ->with('codigoAprobado', true)
                ->with('error', true)
                ->withInput();
            }

            Usuarios::create([
                'no_cuenta' => $noCuenta,
                'nombre' => $nombre,
                'apellido_paterno' => $paterno,
                'apellido_materno'=> $materno,
                'telefono' => $telefono,
                'estatus' => true,
            ]);
    
            $usuario = DB::table('usuarios')->where('no_cuenta', $noCuenta)->value('id');
    
            
            Horario::create([
                'id_usuario' => $usuario,
                'entrada_lunes' => $entradaLunes,
                'salida_lunes' => $salidaLunes,
                'entrada_martes' => $entradaMartes,
                'salida_martes' => $salidaMartes,
                'entrada_miercoles' => $entradaMiercoles,
                'salida_miercoles' => $salidaMiercoles,
                'entrada_jueves' => $entradaJueves,
                'salida_jueves' => $salidaJueves,
                'entrada_viernes' => $entradaViernes,
                'salida_viernes' => $salidaViernes,
                'entrada_sabado' => $entradaSabado,
                'salida_sabado' => $salidaSabado,
            ]);
    
            $credencialesController = new credencialesController();
            $password = $credencialesController->generarPassword();
            $credencialesController -> enviarCredencialesMaestro($nombre,$correo,$password);
    
            Credenciales1::create([
                'id_usuario' => $usuario,
                'correo' => $correo,
                'password' => $password,
                'rol' => 'maestro',
            ]);
            
            return redirect('/index')->with('status', 'Maestro creado exitosamente. !Se ha enviando un correo con los datos de inicio de sesión!')
            ->with('error', true);
        }
    }

    public function consultaMaestros(Request $request)
    {
        $id = $request->session()->get('id');
        $rol = $request->session()->get('rol');
        $ruta = $request->session()->get('ruta');

        if($rol == 'maestro')
        {
            //$alumnos = Alumno::with('credenciales')->get(); 
            $maestro = Usuarios::find($id);
            $horario = Horario::where('id_usuario', $id)->first();;
            return view('maestros.consulta', compact('maestro','horario'));
        }
        else if($rol !== 'maestro')
        {
            return redirect($ruta);
        }
        else
        {
            return redirect('index');
        }
    }

    public function consultaMaestrosHorarios(Request $request)
    {
        ini_set('memory_limit', '512M');

        $id = $request->session()->get('id');
        $rol = $request->session()->get('rol');
        $ruta = $request->session()->get('ruta');
 
        // Validación de rol y redirección
        if ($rol !== 'maestro') {
            return redirect($ruta ?? 'index');
        }
 
        // Obtener el maestro y su horario, en caso de ser necesario para la vista
        $maestro = Usuarios::find($id);
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
        
        // Verificar si la consulta no devuelve resultados
        if ($query_principal->isEmpty()) {
            return view('maestros.consulta', compact('maestro'))
            ->with('status', 'Sin Datos')
            ->with('error',true);
        }
 
        // Pasar las variables a la vista
        return view('maestros.horarios.horario', compact('maestro', 'horario', 'query_principal', 'option', 'day', 'startDate', 'endDate'));

    }


    public function informacionMaestros(Request $request)
    {
        //obtenemos el id de la session 
        $id = $request->session()->get('id');
  
        //ejecutamos la consulta
        $query_principal = DB::select('
        SELECT a.id, a.no_cuenta, a.nombre, a.apellido_paterno, a.apellido_materno,
        a.telefono, b.correo, b.password
        FROM usuarios a
        INNER JOIN credenciales b ON a.id = b.id_usuario
        WHERE a.id = ?
        ', [$id]);
        
        //dd($query_principal);
        //die();

        //ASEGURAMOS QUE LA CONSULTA CUENTA CON INFORMACION
        if(empty($query_principal))
        {
            return redirect()->back()->withErrors('Usuario o credenciales no encontrado.');
        }


        //pasamos los datos a la vista 
        return view('maestros.cuenta.cuenta', ['maestro' => $query_principal[0]]);

    }

    public function consultaClases(Request $request)
    {
        $id = $request->session()->get('id');
    
        $query_principal = DB::select('
            SELECT horario.*, usuarios.nombre, usuarios.apellido_paterno
            FROM horario
            JOIN usuarios ON horario.id_usuario = usuarios.id
            WHERE horario.id_usuario = ?
        ', [$id]);
        
        //por si requerimos ver el resultado
        //print_r($query_principal);
        //die();

        if (empty($query_principal)) {
            return redirect()->back()->withErrors('El Docente no cuenta con horarios.');
        }
        
        return view('maestros.clases.clases', ['maestro' => $query_principal[0]]);
    }

    public function editarHorario(Request $request)
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
    


    
    public function editarMaestro(Request $request, $id)
    {
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
                'password' => $request->input('password'),
            ]);

        return redirect()->back()->with('status', 'Información actualizada correctamente');
    }

    function validarHoras($entrada, $salida)
    {
        $horaEntrada = $this->convertirHoras($entrada);
        $horaSalida = $this->convertirHoras($salida);
    
        $horaMinima = $this->convertirHoras("07:00");
        $horaMaxima = $this->convertirHoras("18:00");
    
        if ($horaEntrada === 0 && $horaSalida === 0) {
            return "vacio";
        }
    
        if ($horaEntrada === 0 && $horaSalida !== 0) {
            return "hora de entrada no detectada";
        }
    
        if ($horaEntrada !== 0 && $horaSalida === 0) {
            return "hora de salida no detectada";
        }
    
        if ($horaEntrada < $horaMinima) {
            return "La hora de entrada debe ser mayor o igual a las 7:00 AM.";
        }
    
        if ($horaEntrada > ($horaMaxima - 60)) {
            return "La hora de entrada debe ser mayor a las 07:00 AM y menor a las 05:00 PM.";
        }
    
        if ($horaSalida > $horaMaxima) {
            return "La hora de salida debe ser menor o igual a las 6:00 PM.";
        }
    
        if ($horaSalida < ($horaMinima + 60)) {
            return "La hora de salida debe ser mayor a la hora de entrada y menor o igual a las 06:00 PM.";
        }
    
        if ($horaEntrada >= $horaSalida) {
            return "la hora de entrada no puede ser mayor o igual a la hora de salida.";
        }
    
        if ($this->diferenciaHoras($horaEntrada, $horaSalida)) {
            return "El tiempo minimo de permanencia en la universidad es de 1 hora.";
        }
    
        return "";
    
    }
    
    function convertirHoras($hora)
    {
        if (empty($hora)) {
            return 0;
        }
    
        list($horas, $minutos) = explode(":", $hora);
        return $horas * 60 + $minutos;
    }
    
    function diferenciaHoras($entrada, $salida)
    {
        $diferencia = $salida - $entrada;
        return $diferencia < 60;
    }
    




}