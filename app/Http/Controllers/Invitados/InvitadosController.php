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

            
            if($departamentoSolicitado->estatus == false)
            {
                return back()->with('status', 'Por el momento, no se aceptan visitas a este departamento.')->with('error',false)->withInput();
            }

            // Obtenemos el horario del coordinador
            $cordinadorPresente = Horario::where('id_usuario', $departamentoSolicitado->id_usuario)->first();

            if ($cordinadorPresente && is_null($cordinadorPresente->$diaBusquedaEntarda)) 
            {
                return back()->with('status', 'El coordinador no está disponible en la fecha seleccionada. Por favor, programa tu visita para otro día.')->with('error',false)->withInput();
            } 
            else 
            {

                $horaVisita = new DateTime($hora);
                $horaCoordinadorEntrada = $cordinadorPresente->$diaBusquedaEntarda;
                $horaCoordinadorSalida = $cordinadorPresente->$diaBusquedaSalida;
                
                $horaPermitidaEntrada = new DateTime($horaCoordinadorEntrada);

                $horaPermitidaSalida = new DateTime($horaCoordinadorSalida);
                $horaPermitidaSalida->modify('-1 hour');

                $horaVisitaFormato = $horaVisita->format('H:i:s');
                $horaPermitidaSalidaFormato = $horaPermitidaSalida->format('H:i:s');
                $horaPermitidaEntradaFormato = $horaPermitidaEntrada->format('H:i:s');

                if($horaVisitaFormato < $horaPermitidaSalidaFormato && $horaVisitaFormato > $horaPermitidaEntradaFormato)
                {
                    
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
                }
                else
                {
                    return back()->with('status', 'El coordinador no está disponible en la hora seleccionada. Por favor, programa tu visita en otra hora del dia.')->with('error',false)->withInput();
                }
            }
        } 
        else 
        {
            return back()->with('status', 'No se encontro el departamento')->with('error',false)->withInput();
        }
        
        return back()->with('status', 'Esto no deveria de pasar contactate con soporte tecnico')->with('error',false)->withInput();
    }   
}
