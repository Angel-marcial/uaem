<?php
/* 
*
*Codice
*Nombre del Código: AnthGuardMiddleware.php
*Fecha de Creación: 15/08/2024 
Revisado por: José Ángel Monsalvo Cruz
*
*Modificaciones:
*
*Descripción: Este archivo PHP es un middleware en Laravel. Los middleware actúan como intermediarios para procesar solicitudes HTTP antes de que lleguen a las rutas o controladores de tu aplicación, permitiendo aplicar lógica como verificación de autenticación o permisos. 
*/
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthGuardMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $rol = $request->session()->get('rol');

        if(!$request->session()->has('id')) 
        {
            return redirect('index')->with('cerrar session', 'Necesitas iniciar sesión para acceder a esta página.');
        }
        
        return $next($request);
    }
}


