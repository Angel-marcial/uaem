<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthGuardMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if(!$request->session()->has('id')) 
        {
            dd(session()->all());
            dd('Middleware ejecutándose correctamente');
            return redirect('index')->with('cerrar session', 'Necesitas iniciar sesión para acceder a esta página.');
        }

        return $next($request);
    }
}

