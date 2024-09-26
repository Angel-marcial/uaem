<?php

namespace App\Http\Controllers\Maestros;
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
}