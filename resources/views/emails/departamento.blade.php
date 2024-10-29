<!-- 
    Codice
    Nombre del Código: departamento.php
    Fecha de Creación: 29/10/2024 revisado por Angel Geovanni Marcial Morales

    Modificaciones:

    Descripción: Este archivo PHP cuenta con  el contenido del correo que envia la notificacion a un nuevo cordinador 
-->
@component('mail::message')
# Unidad Académica Profesional Tianguistenco
Estimado {{ $nombre }}.
La Unidad Académica Profesional Tianguistenco agradece su compromiso y lealtad.

Se le ha asignado el rol de Coordinador del Departamento {{ $departamento }}.

¡No compartas tus datos con nadie!<br>
¡No respondas a este mensaje!

Coordinación General<br>
{{ config('app.name') }}
@endcomponent

