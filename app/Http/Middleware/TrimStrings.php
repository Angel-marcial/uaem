<?php
/* 
*
*Codice
*Nombre del Código: TrimStrings.php
*Fecha de Creación: 15/08/2024 
Revisado por: José Ángel Monsalvo Cruz
*
*Modificaciones:
*
*Descripción: Este archivo PHP es un middleware en Laravel que se encarga de eliminar los espacios en blanco al inicio y al final de las cadenas de texto enviadas en las solicitudes HTTP, como los datos de formularios. Esto ayuda a garantizar que los datos que se procesan no tengan espacios no deseados, lo que mejora la integridad y consistencia de los datos.
*/
namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

class TrimStrings extends Middleware
{
    /**
     * The names of the attributes that should not be trimmed.
     *
     * @var array<int, string>
     */
    protected $except = [
        'current_password',
        'password',
        'password_confirmation',
    ];
}
