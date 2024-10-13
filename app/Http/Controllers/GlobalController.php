<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Credenciales1;
use App\Models\Usuarios;

class GlobalController extends Controller
{
    //valida correo en todo los casos
    public function validarCorreo($correo)
    {
        return Credenciales1::pluck('correo')->contains($correo);
    }
    //estructura de correo




    //validar numero de cuenta
    public function validarCuenta($cuenta)
    {
        return Usuarios::pluck('no_cuenta')->contains($cuenta);
    }
    //validar que el numero de cuenta tenga 7 dijitos 
    public function tamanioCuenta($cuenta)
    {
        if(strlen($cuenta) < 7)
        {
            return true;
        }
        else
        {
            return false;
        }
    }   



    //se busca el numero de cuenta 
    public function buscarNumero($telefono)
    {
        return Usuarios::pluck('telefono')->contains($telefono);
    }
    //validar textos
    public function validacionesTextos(string $texto, string $campo): string
    {
        $regexPalabra = '/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/';

        //El apellido materno solo puede contener letras
        if(empty($texto))
        {
            return "El campo " . $campo . " no puede estar vacio";
        }

        if(!preg_match($regexPalabra, $texto))
        {
            return "El " . $campo . " solo puede contener letras";
        }

        return "";
    } 

    public function validarNumero(string $numero): string
    {
        $cantidadDeDigitos = strlen((string)$numero);

        //"El número de teléfono debe tener exactamente 10 dígitos.";
        if(empty($numero))
        {
            return "Numero de telefono obligatorio";
        }

        if($cantidadDeDigitos !== 10)
        {
            return "El número de teléfono debe tener exactamente 10 dígitos.";
        }

        return "";
    }

    

}