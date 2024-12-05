<?php
/* 
*
*Codice
*Nombre del Código: AdminCoordinadoresController.php
*Fecha de Creación: 15/08/2024 
Revisado por: José Ángel Monsalvo Cruz
*
*Modificaciones:
*
*Descripción: Este archivo PHP cuenta con las operaciones para Coordinadores 
*/
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coordinadores;
use App\Models\Usuarios;
use Illuminate\Http\Request;

class AdminCoordinadoresController extends Controller
{
    //cordinadores
    public function tablaCoordinadores(Request $request)
    {
        $id = $request->session()->get('id');
        $rol = $request->session()->get('rol');
        $ruta = $request->session()->get('ruta');

        $admin = Usuarios::find($id);
        //$alumnos = Alumnos::get();

        $coordinadores = Coordinadores::where('id_usuario', 'like', '%'.$request->input('search').'%')->paginate(4);
        return view('administradores.departamentos.departamentos', compact('admin','coordinadores'));
    }

    //buscar coordinador
    public function buscarCoordinador(Request $request)
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
            $coordinadores = Coordinadores::where('no_cuenta', 'like', '%' . $search . '%')
                ->orWhere('nombre', 'like', '%' . $search . '%')
                ->orWhere('apellido_paterno', 'like', '%' . $search . '%')
                ->paginate(4); // Paginación con 10 alumnos por página
        } else {
            $coordinadores = Coordinadores::paginate(4); // Paginación con 10 alumnos por página si no hay búsqueda
        }
        if ($request->ajax()) 
        {
            return response()->json($coordinadores);
        }

        return view('administradores.departamentos.departamentos', compact('admin', 'coordinadores'));
    }

    public function adminNuevoCordinador(Request $request)
    {
        $id = $request->session()->get('id');
        $rol = $request->session()->get('rol');
        $ruta = $request->session()->get('ruta');

        $admin = Usuarios::find($id);

        return view('administradores.departamentos.nuevoDepartamento',compact('admin'));
    }


}