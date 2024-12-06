<?php
/* 
*
*Codice
*Nombre del Código: EncryptCookies.php
*Fecha de Creación: 15/08/2024 
Revisado por: José Ángel Monsalvo Cruz
*
*Modificaciones:
*
*Descripción: Este archivo PHP es un middleware de Laravel que se encarga de manejar la cifrado y descifrado de cookies utilizadas en la aplicación. Esto garantiza la seguridad de la información almacenada en las cookies al protegerla contra accesos no autorizados o manipulaciones.
*/
namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class EncryptCookies extends Middleware
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];
}
