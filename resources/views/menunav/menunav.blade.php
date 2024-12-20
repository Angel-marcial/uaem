<!--
    @author VLADIMIR LEMUS
    Codice
    Nombre del Código: sidebar.blade.php
    Fecha de Creación: 28/10/2024 revisado por Angel Geovanni Marcial Morales

    Modificaciones:

    Descripción: Este archivo PHP contiene el sidebar del administrador 
-->
<?php 

$tipo = session('rol');

if (!$tipo)
{
    $nombreArchivo = basename(__FILE__);


    switch($nombreArchivo)
    {
        case '9ccced337fbfafd9635af00120531477.php':
            $prueba;
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
    case 'cordinador':
        ?>
        <div class="sidebar">
            <div class="p-3">
                <h5><i class=""></i>{{ old('numeroCuenta', $cordinador->nombre." ".$cordinador->apellido_paterno ?? '') }}</h5>
                
                <hr>
                <a class="active" href="{{ url('index-admin') }}"><i class="bi bi-house-door"></i> Home</a>
                <a href="{{ url('cordinador-registros') }}"><i class="" id="dashboard"></i> Registros</a>
                <a href="{{ url('cordinador-horarios') }}"><i class=""></i> Horarios</a>
                <a href="{{ url('cordinador-cuenta') }}"></i> Cuenta</a>
                <a href="{{ url('coordinador-consulta-peticiones') }}"></i> Peticiones</a>   
            </div>
        </div>
            
        <?php
        break;

    case 'administrador':
        ?>
            <div class="sidebar">
                <div class="p-3">
                    <h5><i class=""></i>{{ old('numeroCuenta', $admin->nombre." ".$admin->apellido_paterno ?? '') }}</h5>
                        <hr>
                        <a class="active" href="{{ url('index-admin') }}" data-url="{{ url('index-admin') }}" class="ajax-link"><i class="bi bi-house-door"></i>Home</a>
            
                        <a href="#" data-url="{{ url('admin-dashboard') }}" class="ajax-link"><i class=""></i>Dashboard</a>
                        <a href="#" data-url="{{ url('admin-consulta-alumnos') }}" class="ajax-link"><i class=""></i>Alumnos</a>
                        <a data-url="{{ url('admin-consulta-maestros') }}" class="ajax-link"><i class=""></i>Maestros</a>
                        <a data-url="{{ url('admin-consulta-guardias') }}" class="ajax-link"></i>Guardias</a>
                        <a data-url="{{ url('admin-consulta-coordinador') }}" class="ajax-link"><i class=""></i>Departamentos</a>
                        <a data-url="{{ url('admin-consulta-peticiones') }}" class="ajax-link"></i>Peticiones</a>
                        
                </div>
            </div>
            
        <?php
        break;
    case 'alumno':
            ?>
            <div class="sidebar">
                <div class="p-3">
                    <h5><i class=""></i>{{ old('numeroCuenta', $alumno->nombre." ".$alumno->apellido_paterno ?? '') }}</h5>
                        <hr>
                        <a class="active" href="{{ url('index-admin') }}" data-url="{{ url('index-admin') }}" class="ajax-link"><i class="bi bi-house-door"></i>Home</a>
                        <a href="{{url('alumnos-ingresos')}}" data-url="{{ url('index-admin') }}" class="ajax-link"><i class="" id="dashboard"></i>Registros</a>
                        <a href="{{url('alumno-cuenta')}}"  data-url="{{ url('alumno/cuenta') }}" class="ajax-link"></i>Cuenta</a>
                </div>
            </div>
            <?php
        break;

        case 'altaAlumno':
            ?>

            <?php
        break;

        case 'maestro':
        ?>
            <div class="sidebar">
                <div class="p-3">
                    <h5><i class=""></i>{{ old('numeroCuenta', $maestro->nombre." ".$maestro->apellido_paterno ?? '') }}</h5>
                        <hr>
                        <a class="active" href="{{ url('index-admin') }}" data-url="{{ url('index-admin') }}" class="ajax-link"><i class="bi bi-house-door"></i>Home</a>
                        <a href="{{ url('maestros-horarios') }}" data-url="{{ url('maestros/horarios') }}" class="ajax-link"><i class=""></i>Registros</a>
                        <a href="{{ url('maestros-clases') }}" data-url="{{ url('maestros/clases') }}" class="ajax-link"><i class=""></i>Horarios</a>
                        <a href="{{url('maestros-cuenta')}}"  data-url="{{ url('maestros/cuenta') }}" class="ajax-link"></i>Cuenta</a>
                </div>
            </div>
        <?php
        break;

    default:
        // Código a ejecutar si $variable no coincide con ninguno de los casos anteriores
        echo "Valor no encontrado";
        break;
}
}

?>