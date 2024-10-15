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


}