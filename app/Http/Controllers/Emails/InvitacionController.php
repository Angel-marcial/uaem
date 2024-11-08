<?php

namespace App\Http\Controllers\Emails;
use App\Http\Controllers\Controller;
use App\Mail\Invitaciones;
use App\Models\Departamentos;
use App\Models\Invitados;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class InvitacionController extends Controller
{
    public function EnviarQr($id)
    {

        $datos = Invitados::where('id', $id)->first();
        $area = Departamentos::where('id', $datos->area_visita)->first();

        $correo = $datos->correo;
        $nombre = $datos->nombre_completo;
        $fecha = $datos->fecha_visita;
        $hora = $datos->hora_visita;
        $departamento = $area->nombre_departamento;
        $rol = "invitado";

        $data = 'nombre: ' . $nombre . 'fecha: ' . $fecha . 'hora: ' . $hora . 'departamento: ' . $departamento . 'rol: ' . $rol;
    
        // Generar el código QR y guardarlo en el almacenamiento
        $qrCode = QrCode::format('png')->size(300)->generate($data);
    
        // Guardar la imagen en el almacenamiento
        $qrFilePath = storage_path('app/public/qr_code.png');
        file_put_contents($qrFilePath, $qrCode);
    
        // Enviar el correo con el QR adjunto
        Mail::to($correo)->send(new Invitaciones($nombre, $fecha, $hora, $departamento, $rol, $qrFilePath));

        Invitados::where('id', $id)->update([
            'estatus' => true,
        ]);

        return back()->with('status', 'Se ha notificado al invitado'. $data)->with('error',true)->withInput();

    }

}