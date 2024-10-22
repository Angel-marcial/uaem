<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumnos;
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

        $alumnos = Alumnos::where('id', 'like', '%'.$request->input('search').'%')->paginate(4);
        return view('administradores.departamentos.departamentos', compact('admin','alumnos'));
    }




}