<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Usuarios;
use Illuminate\Http\Request;

class AdminAlumnosController extends Controller
{
    public function adminNuevoAlumno(Request $request)
    {
        $id = $request->session()->get('id');
        $rol = $request->session()->get('rol');
        $ruta = $request->session()->get('ruta');

        $admin = Usuarios::find($id);

        return view('administradores.alumnos.nuevoAlumno',compact('admin'));
    }


    public function nuevoAlumno(Request $request)
    {


    }


}