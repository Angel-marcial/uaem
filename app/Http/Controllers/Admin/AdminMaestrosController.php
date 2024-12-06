<?php
/* 
*
*Codice
*Nombre del Código: AdminMaestrosController.php
*Fecha de Creación: 15/08/2024 
Revisado por: José Ángel Monsalvo Cruz
*
*Modificaciones:
*
*Descripción: Este archivo PHP cuenta con las operaciones para Maestros 
*/

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Maestros;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        if ($search){
            $maestros = Maestros::where('no_cuenta', 'like', '%' . $search . '%')
                ->orWhere('nombre', 'like', '%' . $search . '%')
                ->orWhere('apellido_paterno', 'like', '%' . $search . '%')
                ->paginate(4); // Paginación con 10 alumnos por página
        } else{
            $maestros = Maestros::paginate(4); // Paginación con 10 alumnos por página si no hay búsqueda
        }
        if ($request->ajax()){
            return response()->json($maestros);
        }
    
        return view('administradores.maestros.maestros', compact('admin', 'maestros'));
    }

    //eliminar alumno
    public function eliminarMaestro(Request $request, $cuenta)
    {
        // Buscar al maestro por número de cuenta
        $maestro = Usuarios::where('no_cuenta', $cuenta)->first();
    
        // Verificar si el maestro existe
        if (!$maestro) {
            return redirect()->back()->with('status', 'El maestro no fue encontrado.')->with('error', false);
        }
    
        // Eliminar registros relacionados en las tablas 'ingresos' y 'salidas'
        DB::table('ingresos')->where('id_usuario', $maestro->id)->delete();
        DB::table('salidas')->where('id_usuario', $maestro->id)->delete();
        
        // Finalmente, eliminar al maestro
        $maestro->delete();
    
        // Recargar la misma página con un mensaje de éxito
        return redirect()->back()->with('status', 'Maestro eliminado con éxito.')->with('success', true);
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