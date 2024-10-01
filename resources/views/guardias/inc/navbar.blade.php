<!--
    Codice
    Nombre del Código: navbar.blade.php
    Fecha de Creación: 27/09/2024 revisado por Angel Geovanni Marcial Morales

    Modificaciones:

    Descripción: Este archivo PHP contiene la cabecera de la interfaz guardias.
-->

<div class="container mt-5">
    <nav class="navbar custom-bg  fixed-top "> <!--navbar-expand-lg        -->
    <div class="container-fluid "> 

        <img src="{{ asset('logo.png') }}" alt="Logo" class="img-fluid" style="height: 50px;">

        <h2 class="cabecera mx-auto" >Universidad Autónoma del Estado de México</h2>

        <form action="{{ url('cerrar-session') }}" method="POST" style="display: inline;">
            @csrf
            <button class="navbar-toggler btn-cabecera" type="submit" aria-label="Cerrar sesión">
                <h3><</h3>
            </button>
        </form>
        
        
    </div>
    </nav>
</div>
