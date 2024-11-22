<?php

namespace App\Http\Controllers\Guardias;
use App\Http\Controllers\Controller;
use App\Models\Ingresos;
use App\Models\IngresosInvitados;
use App\Models\Salidas;
use DateTime;
use Illuminate\Http\Request;

class GuardiasController extends Controller
{
    public function indexGuardias(Request $request)
    {
        $id = $request->session()->get('id');
        $rol = $request->session()->get('rol');
        $ruta = $request->session()->get('ruta');

        if($rol == 'guardia')
        {
            return view('guardias.indexGuardia');
        }
        else if($rol !== 'guardia')
        {
            return redirect($ruta);
        }
        else
        {
            return redirect('index');
        }
    }

    //Id: 13 | Nombre: Gabriela Martinez Diaz | No. Cuenta: 1970667 | Status: true | Rol: cordinador | Fecha: 20/11/2024 | Hora: 05:49:32
    //Id: 0 | Nombre: Angel Geovanni | No. Cuenta: 0000000 | Status: true | Rol: invitado | Fecha: 20/11/2024 | Hora: 11:21:00
    public function guardarEntradasSalidas(Request $request)
    {
        // Validaciones
        $tipo = $request->input('tipo');
        $id_usuario = $request->input('id_usuario');
        $fecha = $request->input('fecha');
        $hora = $request->input('hora_ingreso');
        $dia = $request->input('dia');
        $rol = $request->input('rol');


        $fecha_objeto = DateTime::createFromFormat('d/m/Y', $fecha);
        $fecha_transformada = $fecha_objeto->format('Y-m-d');

        if($tipo == "Ingresos")
        {
            if($rol == "invitado")
            {
                
                IngresosInvitados::create([
                    'id_invitado' => $id_usuario,
                    'hora_ingreso' => $hora,
                    'hora_salida' => null,
                ]);


                return response()->json(['status' => 'success g', 'message' => 'Datos procesados correctamente'], 200);

            }
            else
            {
                $ingres =  Ingresos::create([
                    'id_usuario' => $id_usuario,
                    'fecha' => $fecha_transformada,
                    'hora_ingreso' => $hora,
                    'dia' => $dia
                ]);

                return response()->json(['status' => 'success', 'message' => 'Datos procesados correctamente'], 200);

            }


        }else if($tipo == "Salidas")
        {
            if($rol == "invitado")
            {
                $ingres = IngresosInvitados::where('id_invitado', $id_usuario)->update([
                    'id_invitado' => $id_usuario,
                    'hora_salida' => $hora,
                ]);

                return response()->json(['status' => 'success', 'message' => 'Datos procesados correctamente'], 200);

            }
            else
            {
                $ingres = Salidas::create([
                    'id_usuario' => $id_usuario,
                    'fecha' => $fecha_transformada,
                    'hora_salida' => $hora,
                    'dia' => $dia
                ]);
            }

            return response()->json(['status' => 'success', 'message' => 'Datos procesados correctamente'], 200);

        
        }else 
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Tipo inválido'
            ], 400);
        }
    }
}