<?php
/* 
*
*Codice
*Nombre del Código: ApiController.php
*Fecha de Creación: 15/08/2024 
Revisado por: José Ángel Monsalvo Cruz
*
*Modificaciones:
*
*Descripción: Este archivo PHP cuenta con las operaciones para manejo de las Credenciales
*/
namespace App\Http\Controllers\Emails;

use App\Http\Controllers\Controller;
use App\Mail\Credenciales;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class credencialesController extends Controller
{
    public function enviarCredencialesAlumno($nombre, $correo, $password)
    {
        $destinatario = $correo;

        Mail::to($destinatario)->send(new Credenciales($nombre, $correo, $password));
    }

    public function enviarCredencialesMaestro($nombre, $correo, $password)
    {
        $destinatario = $correo;

        Mail::to($destinatario)->send(new Credenciales($nombre, $correo, $password));
    }

    public function generarPassword()
    {
        $length = 10;
        
        $letters = Str::random($length / 2);
        $numbers = substr(str_shuffle('0123456789'), 0, $length / 2);
    
        // Unir las letras y números y mezclar
        $password = str_shuffle($letters . $numbers);
    
        return $password;
    }

}
