<?php

namespace App\Http\Controllers\Emails;
use App\Http\Controllers\Controller;
use App\Mail\Invitaciones;
use App\Mail\RechazarInvitacion;
use App\Models\Departamentos;
use App\Models\Invitados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class InvitacionController extends Controller
{
    public function EnviarQr($id)
    {
        /*
            const idQr = resultText.match(/Id:\s*(.*)/)[1];
            const nombreQr = resultText.match(/Nombre:\s*(.*)/)[1];
            const noCuentaQr = resultText.match(/No\. Cuenta:\s*(\d+)/)[1];
            const statusQr = resultText.match(/Status:\s*(\w+)/)[1];
            const rolQr = resultText.match(/Rol:\s*(\w+)/)[1];
            const fechaQr = resultText.match(/Fecha:\s*(\d{2}\/\d{2}\/\d{4})/)[1];
            hora
        */

        $datos = Invitados::where('id', $id)->first();
        $area = Departamentos::where('id', $datos->area_visita)->first();

        $correo = $datos->correo;
        $nombre = $datos->nombre_completo;
        $fecha = date('d/m/Y', strtotime($datos->fecha_visita));
        $hora = $datos->hora_visita;
        $rol = "invitado";
        $departamento = $area->nombre_departamento;
        

        $data = 'Id: ' . $datos->id .   "\n" .
        'Nombre: ' . $nombre . "\n" .
        'No. Cuenta: 0000000' . "\n" .
        'Status: true' . "\n" .
        'Rol: ' . $rol . "\n" .
        'Fecha: ' . $fecha . "\n" .
        'Hora: ' . $hora;

        // Generar el código QR y guardarlo en el almacenamiento
        $qrCode = QrCode::format('png')->size(300)->generate($data);
    
        // Guardar la imagen en el almacenamiento
        $qrFilePath = storage_path('app/public/qr_code.png');
        file_put_contents($qrFilePath, $qrCode);
    
        // Enviar el correo con el QR adjunto
        Mail::to($correo)->send(new Invitaciones($nombre, $fecha, $hora, $departamento, $rol, $qrFilePath));

        Invitados::where('id', $id)->update([
            'estatus' => 1,
        ]);

        return back()->with('status', 'Se ha notificado al invitado')->with('error',true)->withInput();

    }


    //eliminar guardia
    public function cancelaInvitacion($id)
    {
        
        $cancelarInvitacion = Invitados::where('id', $id)->first();

        if (!$cancelarInvitacion) {
            return redirect('admin-consulta-peticiones')->with('status', 'El Invitado no fue encontrado.')->with('error',false);
        }
        else
        {
            $cancelarInvitacion->update(['estatus' => 2]);

            Mail::to($cancelarInvitacion->correo)->send(new RechazarInvitacion($cancelarInvitacion->nombre_completo));

            return redirect('admin-consulta-peticiones')->with('status', 'El Invitado no fue aceptado, Se le notificara al correo: ' . $cancelarInvitacion->correo)->with('error',false);
        }
    }

}