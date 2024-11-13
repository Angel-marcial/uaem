<!-- 
    Codice
    Nombre del Código: rechazarInvitacion.php
    Fecha de Creación: 05/11/2024 revisado por Angel Geovanni Marcial Morales

    Modificaciones:

    Descripción: Este archivo PHP cuenta con  el contenido del correo que envia el correo a los invitados 
-->

@component('mail::message')
# Unidad Académica Profesional Tianguistenco
Estimado {{ $nombre }}.

Tu solicitud no fue aceptada. Por favor, genera una nueva invitación.

Coordinación General<br>
{{ config('app.name') }}
@endcomponent