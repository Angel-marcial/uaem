<?php
/*
Codice
Nombre del Código: Handler.php
Fecha de Creación: 01/11/2024 revisado por Angel Geovanni Marcial Morales

Modificaciones:

Descripción: Este archivo Handler.php forma parte del sistema de gestión de excepciones de Laravel y se encuentra en el directorio App\Exceptions. Su propósito principal es manejar las excepciones que se producen en la aplicación, proporcionando una estructura para capturarlas, registrarlas y personalizar cómo se responden. 

*/
namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
