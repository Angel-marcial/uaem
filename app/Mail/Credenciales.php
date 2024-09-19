<?php
/*
*Codice
*Nombre del Código: Credenciales.php
*Fecha de Creación: 17/09/2024 revisado por Angel Geovanni Marcial Morales
*
*Modificaciones:
*
*Descripción: Este archivo PHP cuenta con  el contenido del correo que envia las credenciales de inicio de sesion 
*/

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Credenciales extends Mailable
{
    use Queueable, SerializesModels;

    public $nombre;
    public $correo;
    public $password;

    /**
     * Create a new message instance.
     *
     * @param string $nombre
     * @param int $correo
     * @param int $password
     */
    public function __construct($nombre, $correo, $password)
    {
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.credenciales')
                    ->subject('Universidad Autónoma del Estado de México');
    }
}