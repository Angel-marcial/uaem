<?php

namespace App\Http\Controllers\Guardias;
use App\Http\Controllers\Controller;
use App\Models\Ingresos;
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
            $ingres =  Ingresos::create([
                'id_usuario' => $id_usuario,
                'fecha' => $fecha_transformada,
                'hora_ingreso' => $hora,
                'dia' => $dia
            ]);

            return response()->json($ingres . "--" . $tipo . "--" . $id_usuario . "--" . $fecha . "--" . $hora . "--" . $dia . "--" . $rol);

        }else if($tipo == "Salidas")
        {
            $ingres = Salidas::create([
                'id_usuario' => $id_usuario,
                'fecha' => $fecha_transformada,
                'hora_salida' => $hora,
                'dia' => $dia
            ]);

            return response()->json($ingres . "--" . $tipo . "--" . $id_usuario . "--" . $fecha . "--" . $hora . "--" . $dia . "--" . $rol);
        }else 
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Tipo inválido'
            ], 400);
        }
    }
}