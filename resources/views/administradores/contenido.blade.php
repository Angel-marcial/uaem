<!--
    Codice
    Nombre del Código: contenido.blade.php
    Fecha de Creación: 08/10/2024 revisado por Angel Geovanni Marcial Morales

    Modificaciones:

    Descripción: Este archivo PHP contiene las dependencias, fuentes y links que usuara la interfaz administrador
-->
 
<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Administrador</title>
        <link href="{{ asset('logo.png') }}" rel="icon" type="image/png">

        <!--Bootstrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"></link>     
        
        <!--Fuentes-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        
        <!--Estilos-->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    </head> 

    <body>

        <!--ESTE es el navegador-->
        @include('navbar.navbar')
        @include('menunav.menunav')


        <div class="py-3" id="contenido-principal">  
            @yield('content')
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            // Interceptamos el clic en los enlaces
            $('.ajax-link').on('click', function(e) {
                e.preventDefault();  // Evita que el enlace recargue la página
        
                var url = $(this).data('url');  // Obtiene la URL del enlace       
                // Realiza una solicitud AJAX a la URL
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(response) {
                        // Inserta el contenido en el div
                        $('#contenido-principal').html(response);
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            });
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
        <script src="{{ asset('js/botones.js') }}"></script>
        <script src="{{ asset('js/validaciones.js') }}"></script>
        <script src="{{ asset('js/administrador/sidebar.js') }}"></script>
        <script src="{{ asset('js/administrador/admin.js') }}"></script>
        <script src="{{ asset('js/administrador/adminAlumno.js') }}"></script>
        <script src=" {{ asset('js/alumnos/alumno.js')}}"></script>

    </body>

</html>

