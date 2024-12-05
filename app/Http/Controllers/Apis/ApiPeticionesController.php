<?php
/* 
*
*Codice
*Nombre del Código: ApiController.php
*Fecha de Creación: 15/08/2024 
Revisado por: José Ángel Monsalvo Cruz
*
*Modificaciones:
*
*Descripción: Este archivo PHP cuenta con las operaciones para manejo de informacion de las peticiones
*/
namespace App\Http\Controllers\Apis;
use App\Http\Controllers\Controller;
use App\Mail\Invitaciones;
use App\Mail\RechazarInvitacion;
use App\Models\Coordinadores;
use App\Models\Departamentos;
use App\Models\Invitados;
use App\Models\Peticiones;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ApiPeticionesController extends Controller
{
    public function peticiones($id)
    {
        //$usuarios = Usuarios::all();

        $departamentoSolicitado = Peticiones::where('id_cordinador', $id)->get();


        return response()->json($departamentoSolicitado);
    }


    public function aceptarPeticion($id)
    {
        try {
            // Obtener datos del invitado
            $datos = Invitados::where('id', $id)->first();
            if (!$datos) {
                return response()->json(['message' => 'Invitado no encontrado'], 404);
            }
    
            $area = Departamentos::where('id', $datos->area_visita)->first();
            if (!$area) {
                return response()->json(['message' => 'Departamento no encontrado'], 404);
            }
    
            // Preparar datos para el QR y el correo
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
    
            // Generar el código QR
            $qrCode = QrCode::format('png')->size(300)->generate($data);
            $qrFilePath = storage_path('app/public/qr_code.png');
            file_put_contents($qrFilePath, $qrCode);
    
            // Enviar el correo con el QR
            Mail::to($correo)->send(new Invitaciones($nombre, $fecha, $hora, $departamento, $rol, $qrFilePath));
    
            // Eliminar el archivo QR después del envío
            if (file_exists($qrFilePath)) {
                unlink($qrFilePath);
            }
    
            // Actualizar el estado del invitado
            Invitados::where('id', $id)->update(['estatus' => 1]);
    
            return response()->json(['message' => 'Operación realizada con éxito'], 200);
        } catch (\Exception $e) {
            // Manejar errores y devolver una respuesta apropiada
            return response()->json([
                'message' => 'Ocurrió un error al procesar la petición',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    


    public function rechazarPeticion($id)
    {
        $cancelarInvitacion = Invitados::where('id', $id)->first();

        
        $cancelarInvitacion->update(['estatus' => 2]);

        Mail::to($cancelarInvitacion->correo)->send(new RechazarInvitacion($cancelarInvitacion->nombre_completo));

        return response()->json(['message' => 'Operación realizada con éxito'], 200);

    }

    /*
    public function EnviarQr($id)
    {

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
            'estatus' => true,
        ]);

        return back()->with('status', 'Se ha notificado al invitado')->with('error',true)->withInput();

    }
    */


}

