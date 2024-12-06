<?php
/* 
*
*Codice
*Nombre del Código: TrustProxies.php
*Fecha de Creación: 15/08/2024 
Revisado por: José Ángel Monsalvo Cruz
Descripción añadida por: Alejandro Cejudo Tovar 
*
*Modificaciones:
*
*Descripción: Este archivo PHP es un middleware en Laravel que se utiliza para gestionar los proxies confiables de la aplicación. Laravel usa este middleware para manejar correctamente las solicitudes que pasan a través de proxies, como los que suelen estar presentes en configuraciones de balanceo de carga o cuando la aplicación está detrás de un servidor proxy (por ejemplo, en un entorno de nube o un servidor web que utiliza un proxy reverso).
*/
namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array<int, string>|string|null
     */
    protected $proxies;

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    protected $headers =
        Request::HEADER_X_FORWARDED_FOR |
        Request::HEADER_X_FORWARDED_HOST |
        Request::HEADER_X_FORWARDED_PORT |
        Request::HEADER_X_FORWARDED_PROTO |
        Request::HEADER_X_FORWARDED_AWS_ELB;
}
