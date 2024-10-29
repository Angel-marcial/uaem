<?php
/*
*Codice
*Nombre del Código: Departamento.php
*Fecha de Creación: 29/10/2024 revisado por Angel Geovanni Marcial Morales
*
*Modificaciones:
*
*Descripción: Este archivo PHP cuenta con  el contenido del correo que notifica al cordinador  
*/

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Departamento extends Mailable
{
    use Queueable, SerializesModels;

    public $nombre;
    public $departamento;

    /**
     * Create a new message instance.
     *
     * @param string $nombre
     * @param string $departamento;
     */
    public function __construct($nombre, $departamento)
    {
        $this->nombre = $nombre;
        $this->departamento = $departamento;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.departamento')
                    ->subject('Universidad Autónoma del Estado de México');
    }
}