<!-- 
    Codice
    Nombre del Código: invitadosCorreo.php
    Fecha de Creación: 05/11/2024 revisado por Angel Geovanni Marcial Morales

    Modificaciones:

    Descripción: Este archivo PHP cuenta con  el contenido del correo que envia el correo a los invitados 
-->

@component('mail::message')
# Unidad Académica Profesional Tianguistenco
Estimado {{ $nombre }}.
Tes esperamos en la fecha {{ $fecha }}
hora {{ $hora }}
En el deprtamento de {{ $departamento }}


La Unidad Académica Profesional Tianguistenco agradece su compromiso y lealtad.

El siguiente código te permitirá ingresar a la universidad. Este será válido por 1 hora después de agendar la cita. Una vez transcurrido este tiempo, tu cita será cancelada.

Presenta el QR con los guardias de la unidad. 

![Código QR]({{ $message->embed($qrFilePath) }})



¡No compartas tu informacion con nadie!<br>


Coordinación General<br>
{{ config('app.name') }}
@endcomponent