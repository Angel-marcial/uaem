<?php

namespace App\Http\Controllers\Invitados;
use App\Http\Controllers\Controller;
use App\Http\Controllers\GlobalController;
use App\Models\Coordinadores;
use App\Models\Horario;
use App\Models\Invitados;
use DateTime;
use Illuminate\Http\Request;


class InvitadosController extends Controller
{
    public function crearInvitacion(Request $request)
    {
        $nombre = $request->input('nombres');
        $correo = $request->input('correo');
        $telefono = $request->input('telefono');
        $areas = $request->input('areas');
        $hora = $request->input('hora');
        $fecha = $request->input('fecha');
        $motivo = $request->input('motivo');
        
        $globalController = new GlobalController();
        $mensajeTelefono = $globalController->validarNumero($telefono);

        $diaSemana = date("l", strtotime($fecha));
        
        $diasSemanaEntarda = [
            "Monday" => 'entrada_lunes',
            "Tuesday" => 'entrada_martes',
            "Wednesday" => 'entrada_miercoles',
            "Thursday" => 'entrada_jueves',
            "Friday" => 'entrada_viernes',
            "Saturday" => 'entrada_sabado',
            "Sunday" => 'sd',
        ];

        $diasSemanaSalida = [
            "Monday" => 'salida_lunes',
            "Tuesday" => 'salida_martes',
            "Wednesday" => 'salida_miercoles',
            "Thursday" => 'salida_jueves',
            "Friday" => 'salida_viernes',
            "Saturday" => 'salida_sabado',
            "Sunday" => 'sd',
        ];

        $diaBusquedaEntarda = $diasSemanaEntarda[$diaSemana];
        $diaBusquedaSalida = $diasSemanaSalida[$diaSemana];

        if(!$mensajeTelefono == "")
        {
            return back()->with('status', $mensajeTelefono)->with('error', true);
        }

        //buscamos el id la informacion del departamanto 
        $departamentoSolicitado = Coordinadores::where('id_departamento', $areas)->first();
        //buscamos el id del usuario para verificar si existe se presenta el dia de la visita.
        
        // Verificamos si encontramos el coordinador
        if ($departamentoSolicitado) 
        {
            // Obtenemos el horario del coordinador
            $cordinadorPresente = Horario::where('id_usuario', $departamentoSolicitado->id_usuario)->first();
            
            if ($cordinadorPresente && is_null($cordinadorPresente->$diaBusquedaEntarda)) 
            {
                return back()->with('status', 'El coordinador no está disponible en la fecha seleccionada. Por favor, programa tu visita para otro día.')->with('error',false)->withInput();
            } 
            else 
            {
                $horaVisita = new DateTime($hora);
                $horaVisita->modify('-1 hour');

                $horaCoordinadorEntarda = $cordinadorPresente->$diaBusquedaEntarda;
                $horaCoordinadorSalida = $cordinadorPresente->$diaBusquedaSalida;




                echo 'todo bien ' . $horaVisita->format('H:i:s') . ' ------------' . $horaCoordinadorEntarda . ' ------------' . $horaCoordinadorSalida;
            }
        } 
        else 
        {
            echo 'algo salio mal 2';
        }





        /*
        $invitacionCreada =  Invitados::create([
            'nombre_completo' => $nombre,
            'correo' => $correo,
            'telefono' => $telefono,
            'area_visita' => $areas,
            'hora_visita' => $hora,
            'fecha_visita' => $fecha,
            'motivo' => $motivo,
            'estatus' => false,
        ]);





        if ($invitacionCreada) 
        {
            return redirect('index')->with('status', 'El coordinador del departamento ha sido notificado. Recibirás un correo electrónico informándote si tu visita ha sido aprobada.')
            ->with('error',true);        
        }
        */
        
        
        echo "El día de la semana es: " . $diasSemanaEntarda[$diaSemana] . $diasSemanaSalida[$diaSemana];
        
        
        echo $nombre . "----" .  $correo . "----" . $telefono . "----" . $areas . "----" . $hora . "----" . $fecha . "----" . $motivo;

    }   
}
