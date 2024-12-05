<?php
/* 
*
*Codice
*Nombre del Código: AdminPeticionesController.php
*Fecha de Creación: 15/08/2024 
Revisado por: José Ángel Monsalvo Cruz
*
*Modificaciones:
*
*Descripción: Este archivo PHP cuenta con las operaciones para Peticiones 
*/

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invitados;
use App\Models\Usuarios;
use Illuminate\Http\Request;

class AdminPeticionesController extends Controller
{
    public function adminVerPeticiones(Request $request)
    {
        $id = $request->session()->get('id');
        $rol = $request->session()->get('rol');
        $ruta = $request->session()->get('ruta');

        $admin = Usuarios::find($id);
        $peticiones = Invitados::where('area_visita', 1)->get();


        return view('administradores.peticiones.peticiones',compact('admin', 'peticiones'));
    }

    
}