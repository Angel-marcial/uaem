<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GlobalController;
use Illuminate\Http\Request;

class AdminDepartamentosController extends Controller
{

    public function nuevoDepartamento(Request $request)
    {
        $cuenta = $request->input('numeroCuenta');
        $departamento = $request->input('departamento');
        $edificio = $request->input('edificio');
        $aula = $request->input('aula');

        $GlobalController = new GlobalController();

        if($GlobalController->tamanioCuenta($cuenta) == true)
        {
            return back()->with('status', 'El numero de cuenta no cumple con el formato adecuado')->with('error',false)->withInput();
        }

        if($GlobalController->validarCuenta($cuenta, 0) == true)
        {
            return back()->with('status', 'El numero de cuenta ya se encuentra registrado')->with('error',false)->withInput();
        }


        
        
        echo $cuenta . $departamento . $edificio . $aula;
    }




}