<!--
    @author Vladimir Lemus
    Codice
    Nombre del Código: navbar.blade.php
    Fecha de Creación: 28/10/2024 revisado por Angel Geovanni Marcial Morales

    Modificaciones:

    Descripción: Este archivo PHP contiene la cabecera de la interfaz administrador.
-->
<?php

$tipo = session('rol');


if (!$tipo)
{
    $nombreArchivo = basename(__FILE__);

    echo $nombreArchivo;

    switch($nombreArchivo)
    {
        case '7070cf28d5a4595fbbdda560792a19b7.php':
                ?>
                <div class="container mt-5">
                <nav class="navbar custom-bg  fixed-top "> <!--navbar-expand-lg        -->
                <div class="container-fluid "> 
            
                    <img src="{{ asset('logo.png') }}" alt="Logo" class="img-fluid" style="height: 50px;">
        
            
                    <form action="{{ url('cerrar-session') }}" method="POST" style="display: inline;">
                        @csrf
                        <button class="navbar-toggler btn-cabecera" type="submit" aria-label="Cerrar sesión">
                            <h3><</h3>
                        </button>
                    </form>
                    
                </div>
                </nav>
            </div>
                <?php
            break;
        default:
        // Código a ejecutar si $variable no coincide con ninguno de los casos anteriores
        echo "Valor no encontrado";
        break;            
    }


} else 
{
	switch ($tipo)
	{
    case 'administrador':
        ?>
            <div class="container mt-5">
                <nav class="navbar custom-bg  fixed-top "> <!--navbar-expand-lg        -->
                <div class="container-fluid "> 
            
                    <img src="{{ asset('logo.png') }}" alt="Logo" class="img-fluid" style="height: 50px;">
            
                    <h2 class="cabecera mx-auto" >Administración</h2>
            
                    <form action="{{ url('cerrar-session') }}" method="POST" style="display: inline;">
                        @csrf
                        <button class="navbar-toggler btn-cabecera" type="submit" aria-label="Cerrar sesión">
                            <h3><</h3>
                        </button>
                    </form>
                    
                </div>
                </nav>
            </div>
        <?php
        break;
    case 'alumno':
        ?>
            <div class="container mt-5">
                <nav class="navbar custom-bg  fixed-top "> <!--navbar-expand-lg        -->
                <div class="container-fluid "> 
            
                    <img src="{{ asset('logo.png') }}" alt="Logo" class="img-fluid" style="height: 50px;">
            
                    <h2 class="cabecera mx-auto" >Portal Alumno</h2>
            
                    <form action="{{ url('cerrar-session') }}" method="POST" style="display: inline;">
                        @csrf
                        <button class="navbar-toggler btn-cabecera" type="submit" aria-label="Cerrar sesión">
                            <h3><</h3>
                        </button>
                    </form>
                    
                </div>
                </nav>
            </div>
            
        <?php
        break;
    
    case 'altaAlumno':
    ?>
        <div class="container mt-5">
            <nav class="navbar custom-bg  fixed-top "> <!--navbar-expand-lg        -->
            <div class="container-fluid "> 
        
                <img src="{{ asset('logo.png') }}" alt="Logo" class="img-fluid" style="height: 50px;">
        
                <h2 class="cabecera mx-auto" >Alta Alumno</h2>
        
                <form action="{{ url('cerrar-session') }}" method="POST" style="display: inline;">
                    @csrf
                    <button class="navbar-toggler btn-cabecera" type="submit" aria-label="Cerrar sesión">
                        <h3><</h3>
                    </button>
                </form>
                
            </div>
            </nav>
        </div>
        
    <?php
    break;  

    case 'maestro':
        ?>
            <div class="container mt-5">
                <nav class="navbar custom-bg  fixed-top "> <!--navbar-expand-lg        -->
                <div class="container-fluid "> 
            
                    <img src="{{ asset('logo.png') }}" alt="Logo" class="img-fluid" style="height: 50px;">
            
                    <h2 class="cabecera mx-auto" >Portal Maestros</h2>
            
                    <form action="{{ url('cerrar-session') }}" method="POST" style="display: inline;">
                        @csrf
                        <button class="navbar-toggler btn-cabecera" type="submit" aria-label="Cerrar sesión">
                            <h3><</h3>
                        </button>
                    </form>
                    
                </div>
                </nav>
            </div>
        <?php
        break;

    default:
        // Código a ejecutar si $variable no coincide con ninguno de los casos anteriores
        echo "Valor no encontrado";
        break;
	}
}