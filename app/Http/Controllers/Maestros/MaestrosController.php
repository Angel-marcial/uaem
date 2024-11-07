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
    
            return back()->with('status', $mensaje)->with('correoEnviado', false)->withInput();
        }
        else
        {
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
            
            return redirect('/index')->with('status', 'Maestro creado exitosamente. !Se ha enviando un correo con los datos de inicio de sesión!');
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

        // Pasar las variables a la vista
        return view('maestros.horarios.horarios', compact('maestro', 'horario', 'query_principal', 'option', 'day', 'startDate', 'endDate'));
    }


    function editarMaestro(Request $request, $id)
    {
        //campos de entrada
        $nombre = $request->input('nombres');
        $paterno = $request->input('apellidoPaterno');
        $materno = $request->input('apellidoMaterno');
        $telefono = $request->input('telefono'); 
        //mensaje para los errores de los campos de texto 
        $alumnosController = new AlumnosController();
        $mensajeNombre = $alumnosController->validacionesTextos($nombre, "Nombre");
        $mensajePaterno = $alumnosController->validacionesTextos($paterno, "Apellido Paterno");
        $mensajeMaterno = $alumnosController->validacionesTextos($materno, "Apellido Materno");
        $mensajeTelefono = $alumnosController->validarNumero($telefono);
        //campos de entrda para los dias y mensajes para los errores de las horas 
        //lunes
        $entradaLunes = $request->input('entradaLunes');
        $salidaLunes = $request->input('salidaLunes');
        $lunesMensaje = $this->validarHoras($entradaLunes,$salidaLunes);
        // Martes
        $entradaMartes = $request->input('entradaMartes');
        $salidaMartes = $request->input('salidaMartes');
        $martesMensaje = $this->validarHoras($entradaMartes, $salidaMartes);
        // Miércoles
        $entradaMiercoles = $request->input('entradaMiercoles');
        $salidaMiercoles = $request->input('salidaMiercoles');
        $miercolesMensaje = $this->validarHoras($entradaMiercoles, $salidaMiercoles);
        // Jueves
        $entradaJueves = $request->input('entradaJueves');
        $salidaJueves = $request->input('salidaJueves');
        $juevesMensaje = $this->validarHoras($entradaJueves, $salidaJueves);
        // Viernes
        $entradaViernes = $request->input('entradaViernes');
        $salidaViernes = $request->input('salidaViernes');
        $viernesMensaje = $this->validarHoras($entradaViernes, $salidaViernes);
        // Sábado
        $entradaSabado = $request->input('entradaSabado');
        $salidaSabado = $request->input('salidaSabado');
        $sabadoMensaje = $this->validarHoras($entradaSabado, $salidaSabado);


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
        //lunes 
        if($lunesMensaje === "vacio")
        {

        }
        else if($lunesMensaje != "") 
        {
            return back()->with('status', 'Lunes: ' . $lunesMensaje)
            ->with('error',false)->withInput();
        }
        //martes 
        if($martesMensaje === "vacio")
        {

        }
        else if($martesMensaje != "") 
        {
            return back()->with('status', 'Martes: ' . $martesMensaje)
            ->with('error',false)->withInput();
        }
        //miercoles
        if($miercolesMensaje === "vacio")
        {

        }
        else if($miercolesMensaje != "") 
        {
            return back()->with('status', 'Miercoles: ' . $miercolesMensaje)
            ->with('error',false)->withInput();
        }
        //jueves 
        if($juevesMensaje === "vacio")
        {

        }
        else if($juevesMensaje != "") 
        {
            return back()->with('status', 'Jueves: ' . $juevesMensaje)
            ->with('error',false)->withInput();
        }
        //viernes
        if($viernesMensaje === "vacio")
        {

        }
        else if($viernesMensaje != "") 
        {
            return back()->with('status', 'Viernes: ' . $viernesMensaje)
            ->with('error',false)->withInput();
        }
        //sabado
        if($sabadoMensaje === "vacio")
        {

        }
        else if($sabadoMensaje != "") 
        {
            return back()->with('status', 'Sabado: ' . $sabadoMensaje)
            ->with('error',false)->withInput();
        }

        $usuarioExistente = Usuarios::find($id);
    
        if (!$usuarioExistente) 
        {
            return back()->with('status', 'No se puedo actializar los datos, contacta con soporte tecnico')
            ->with('error',false)->withInput();
        }

        //Verificamos si el teléfono ya existen para otro usuario
        $usuarioDuplicado = Usuarios::where('telefono', $telefono)
        ->where('id', '!=', $id)
        ->first();
    
        if ($usuarioDuplicado) 
        {
            $mensaje = '';
            
            if ($usuarioDuplicado->telefono == $telefono) 
            {
                $mensaje .= 'El número de teléfono ' . $telefono . ' ya está registrado.';
            }

            return back()->with('status', $mensaje)
            ->with('error',false)->withInput();
        }
        else
        {

            Usuarios::where('id', $id)->update([
                'nombre' => $nombre,
                'apellido_paterno' => $paterno,
                'apellido_materno' => $materno,
                'telefono' => $telefono,
            ]);

            Horario::where('id_usuario',$id)->update([
                'entrada_lunes' => $entradaLunes,
                'salida_lunes' => $salidaLunes,
                'entrada_martes' => $entradaMartes,
                'salida_martes' => $salidaMartes,
                'entrada_miercoles' => $entradaMiercoles ,
                'salida_miercoles' => $salidaMiercoles,
                'entrada_jueves' => $entradaJueves,
                'salida_jueves' => $salidaJueves,
                'entrada_viernes' => $entradaViernes,
                'salida_viernes' => $salidaViernes,
                'entrada_sabado' => $entradaSabado,
                'salida_sabado' => $salidaSabado,
            ]);

            return redirect('/consulta-maestros')->with('status', 'Datos actualizado exitosamente.')
            ->with('error',true)->withInput();
        }





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