<!-- 
    Codice
    Nombre del Código: credenciales.php
    Fecha de Creación: 17/09/2024 revisado por Angel Geovanni Marcial Morales

    Modificaciones:

    Descripción: Este archivo PHP cuenta con  el contenido del correo que envia las credenciales de inicio de sesion
-->
@component('mail::message')
# Unidad Académica Profesional Tianguistenco
Estimado {{ $nombre }}

La Unidad Académica Profesional Tianguistenco agradece su compromiso y lealtad. 

sus datos de inicio de sesión son los siguientes:

Usuario: {{ $correo }}
</br>
Contraseña: {{ $password }}

¡No compartas tus datos con nadie!
¡No responda a este mensaje!

Coordinación General<br>
{{ config('app.name') }}
@endcomponent
