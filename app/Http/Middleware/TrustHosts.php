<?php
/* 
*
*Codice
*Nombre del Código: TrustsHosts.php
*Fecha de Creación: 15/08/2024 
Revisado por: José Ángel Monsalvo Cruz
*
*Modificaciones:
*
*Descripción: Este archivo PHP es un middleware en Laravel que se encarga de gestionar los hosts confiables de la aplicación. Es utilizado para asegurarse de que solo se acepten solicitudes provenientes de subdominios o dominios específicos. Esto puede ser útil para reforzar la seguridad y asegurarse de que la aplicación solo reciba solicitudes desde dominios o subdominios que estén explícitamente permitidos.
*/
namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustHosts as Middleware;

class TrustHosts extends Middleware
{
    /**
     * Get the host patterns that should be trusted.
     *
     * @return array<int, string|null>
     */
    public function hosts(): array
    {
        return [
            $this->allSubdomainsOfApplicationUrl(),
        ];
    }
}
