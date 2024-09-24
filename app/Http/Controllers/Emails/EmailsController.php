<?php

namespace App\Http\Controllers\Emails;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\MiCorreo;
use App\Models\Alumno;
use App\Models\Carreras;
use Illuminate\Support\Facades\Mail;


class EmailsController extends Controller
{

    public function enviarCorreoAlumnos(Request $request)
    {
        //'/^[a-zA-Z0-9._%+-]+@gmail\.com$/';
        $correoAlumno = '/^[\w.-]+@alumno\.uaemex\.mx$/';        

        $destinatario = $request->input('correo');

        /*
        $correo s = Alumno::pluck('correo');

        foreach($correos as $correo)
        {
            if($correo == $destinatario)
            {
                return redirect('index-alumnos')->with('status', 'El correo '.$destinatario. ' ya se encuentra registrado')
                ->with('correoEnviado',false);
            }
        }
        */

        if(preg_match($correoAlumno,$destinatario))
        {

            $codigo = random_int(1000000, 9999999);
            $request->session()->put('codigo', $codigo);
            $nombre = 'Alumno'; 
            $request->session()->put('destinatario', $destinatario);
            Mail::to($destinatario)->send(new MiCorreo($nombre, $codigo));

            return redirect('index-alumnos')->with('status', 'se ha enviado un codigo de verificacion al correo: '. $destinatario)
            ->with('correoEnviado',true);

        }
        else
        {
            return redirect('index-alumnos')->with('status', 'El correo proporcionado no es valido: '. $destinatario)
            ->with('correoEnviado',false);
        }
    }

    public function enviarCorreoMaestros(Request $request)
    {
        //$correoMaestro= '/^[\w.-]+@profesor\.uaemex\.mx$/';  
        $correoMaestro = '/^[\w.-]++@gmail\.com$/';     


        $destinatario = $request->input('correo');


        if(preg_match($correoMaestro,$destinatario))
        {

            $codigo = random_int(1000000, 9999999);
            $request->session()->put('codigo', $codigo);
            $nombre = 'profesor'; 

            Mail::to($destinatario)->send(new MiCorreo($nombre, $codigo));

            return redirect('index-maestros')->with('status', 'se ha enviado un codigo de verificacion al correo: '. $destinatario)
            ->with('correoEnviado',true);

        }
        else
        {
            return redirect('index-maestros')->with('status', 'El correo proporcionado no es valido: '. $destinatario)
            ->with('correoEnviado',false);
        } 
    }

    public function codigoSeguridad(Request $request)
    {
        $codigo = $request->session()->get('codigo');
        $ruta = $request->input('redirectRoute');

        $codigoCompleto = 
        $request->input('numero1') .
        $request->input('numero2') .
        $request->input('numero3') .
        $request->input('numero4') .
        $request->input('numero5') .
        $request->input('numero6') .
        $request->input('numero7');

        // Convertir a número si es necesario
        $codigoCompleto = intval($codigoCompleto);


        if($codigo == $codigoCompleto)
        {
            return redirect($ruta)->with('status', 'Codigo de seguridad aprobado')
            ->with('codigoAprobado',true);
        }
        else
        {
            return redirect($ruta)->with('status', 'Codigo de seguridad incorrecto')
            ->with('codigoAprobado',false);
        }

    }

    public function correo()
    {
        return $correo = session()->get('destinatario');
    }
}
