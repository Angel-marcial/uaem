<!-- 
    Codice
    Nombre del Código: correo.blade.php
    Fecha de Creación: 25/09/2024 revisado por Angel Geovanni Marcial Morales

    Modificaciones:

    Descripción: Este archivo PHP cuenta con  el contenido del correo para validacion de alumnos y maestros. 
-->
@component('mail::message')
# Unidad Académica Profesional Tianguistenco
Estimado {{ $nombre }}

Código de verificación 

{{ $codigo }}

¡No responda a este mensaje!

Coordinación General<br>
{{ config('app.name') }}
@endcomponent
