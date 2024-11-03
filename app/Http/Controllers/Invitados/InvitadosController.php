<?php

namespace App\Http\Controllers\Invitados;
use App\Http\Controllers\Controller;
use App\Http\Controllers\GlobalController;
use App\Models\Invitados;
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

        if(!$mensajeTelefono == "")
        {
            return back()->with('status', $mensajeTelefono)->with('error', true);
        }

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
            return redirect('index')->with('status', 'El coordinador del departamento ha sido notificado. Recibirás un correo electrónico informándote si tu visita ha sido aprobada.');        
        }
        

        echo $nombre . "----" .  $correo . "----" . $telefono . "----" . $areas . "----" . $hora . "----" . $fecha . "----" . $motivo;

    }   
}
