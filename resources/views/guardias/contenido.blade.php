<!--
    Codice
    Nombre del Código: contenido.blade.php
    Fecha de Creación: 27/09/2024 revisado por Angel Geovanni Marcial Morales

    Modificaciones:

    Descripción: Este archivo PHP contiene las dependencias, fuentes y links que usuara la interfaz guardias
-->

<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Control de Acceso</title>
        <link href="{{ asset('logo.png') }}" rel="icon" type="image/png">

        <!--Bootstrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"></link>     
        
        <!--Fuentes-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        
        <!--Estilos-->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">


        <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

    </head> 

    <body>

        @include('guardias.inc.navbar')

        <div class="py-3">  
            @yield('content')
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
        <script src=" {{ asset('js/botones.js') }}"></script>
        
    </body>

</html>