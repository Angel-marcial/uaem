<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Maestros;
use App\Models\Usuarios;
use Illuminate\Http\Request;

class AdminMaestrosController extends Controller
{
    //alumnos
    public function tablaMaestros(Request $request)
    {
        $id = $request->session()->get('id');
        $rol = $request->session()->get('rol');
        $ruta = $request->session()->get('ruta');

        $admin = Usuarios::find($id);
        //$alumnos = Alumnos::get();
        $maestros = Maestros::where('id', 'like', '%'.$request->input('search').'%')->paginate(4);
        return view('administradores.maestros.maestros', compact('admin','maestros'));
    }
    //buscar alumno
    public function buscarMaestros(Request $request)
    {
        $id = $request->session()->get('id');
        $rol = $request->session()->get('rol');
        $ruta = $request->session()->get('ruta');
    
        $admin = Usuarios::find($id);
    
        // Obtén la consulta de búsqueda
        $search = $request->input('search');
    
        // Si hay un término de búsqueda, filtrar por él
        if ($search) 
        {
            $maestros = Maestros::where('no_cuenta', 'like', '%' . $search . '%')
                ->orWhere('nombre', 'like', '%' . $search . '%')
                ->orWhere('apellido_paterno', 'like', '%' . $search . '%')
                ->paginate(4); // Paginación con 10 alumnos por página
        } 
        else 
        {
            $maestros = Maestros::paginate(4); // Paginación con 10 alumnos por página si no hay búsqueda
        }
        if ($request->ajax()) 
        {
            return response()->json($maestros);
        }
    
        return view('administradores.maestros.maestros', compact('admin', 'maestros'));
    }

    //eliminar alumno
    public function eliminarMaestro(Request $request, $cuenta)
    {
        
        $maestro = Usuarios::where('no_cuenta', $cuenta)->first();

        // Verificar si el maestro existe
        if (!$maestro) {
            return redirect()->back()->with('status', 'El maestro no fue encontrado.')->with('error',false);
        }
        else
        {
            $maestro->delete();

            return redirect()->back()->with('status', 'Maestro eliminado con exito.')->with('error',true);
        }
    }




    
    //cambiar estatus 
    public function actualizarEstatus(Request $request, $id)
    {


        $usuario = Usuarios::find($id);

        if ($usuario) {

            $usuario->estatus = $request->input('estatus');
            $usuario->save();

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Alumno no encontrado.']);
        }
    }
}