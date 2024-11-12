<?php
/*
*Codice
*Nombre del Código: Invitaciones.php
*Fecha de Creación: 17/09/2024 revisado por Angel Geovanni Marcial Morales
*
*Modificaciones:
*
*Descripción: Este archivo PHP cuenta con  el contenido del correo que envia las credenciales de inicio de sesion 
*/

namespace App\Mail;
use Illuminate\Mail\Mailable;

class Invitaciones extends Mailable
{

    public $nombre;
    public $fecha;
    public $hora;
    public $departamento;
    public $rol;
    public $qrFilePath;


    /**
     * Create a new message instance.
     *
    * @param string $nombre El nombre del usuario.
    * @param string $fecha La fecha de la cita (formato Y-m-d).
    * @param string $hora La hora de la cita (formato H:i:s).
    * @param string $departamento El departamento relacionado con la cita.
    * @param string $qr La ruta o URL de la imagen QR generada.
     * 
     */
    public function __construct($nombre, $fecha, $hora, $departamento, $rol, $qrFilePath)
    {
        $this->nombre = $nombre;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->departamento = $departamento;
        $this->rol = $rol;
        $this->qrFilePath = $qrFilePath;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.invitadosCorreo')
                    ->subject('Universidad Autónoma del Estado de México');
    }

}