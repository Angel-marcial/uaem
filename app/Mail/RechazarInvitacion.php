<?php
/*
*Codice
*Nombre del Código: RechazarInvitacion.php
*Fecha de Creación: 25/09/2024 revisado por Angel Geovanni Marcial Morales
*
*Modificaciones:
*
*Descripción: Este archivo PHP cuenta con  el contenido del correo para validacion de alumnos y maestros. 
*/

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RechazarInvitacion extends Mailable
{
    use Queueable, SerializesModels;

    public $nombre;

    /**
     * Create a new message instance.
     *
     * @param string $nombre
     */
    public function __construct($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.rechazarInvitacion')
                    ->subject('Universidad Autónoma del Estado de México');
    }
}