<!--
    Codice
    Nombre del Código: navbar.blade.php
    Fecha de Creación: 22/08/2024 revisado por Angel Geovanni Marcial Morales

    Modificaciones:

    Descripción: Este archivo PHP contiene la cabecera de la interfaz usuarios.
-->

<div class="container mt-5">
    <nav class="navbar custom-bg  fixed-top "> <!--navbar-expand-lg        -->
    <div class="container-fluid "> 

        <img src="{{ asset('logo.png') }}" alt="Logo" class="img-fluid" style="height: 50px;">

        <h2 class="cabecera mx-auto" >Universidad Autónoma del Estado de México</h2>

        <button class="navbar-toggler btn-cabecera"  type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end contenedor" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title titulos" id="offcanvasNavbarLabel">Universidad Autónoma del Estado de México</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <!--trabajando aqui Angel geovanni-->

            <div class="offcanvas-body ">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item ">
                        <a class="nav-link btn-link-barra" href="{{ url('index-alumnos') }}">Alumnos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn-link-barra" href="{{ url('index-maestros') }}">Maestros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn-link-barra" href="{{ url('index-invitado') }}">Invitado</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    </nav>
</div>
