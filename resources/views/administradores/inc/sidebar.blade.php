<!--
    Codice
    Nombre del Código: sidebar.blade.php
    Fecha de Creación: 09/10/2024 revisado por Angel Geovanni Marcial Morales

    Modificaciones:

    Descripción: Este archivo PHP contiene el sidebar del administrador 
-->
<div class="sidebar">
    <div class="p-3">
        <h5><i class=""></i>{{ old('numeroCuenta', $admin->nombre." ".$admin->apellido_paterno ?? '') }}</h5>
        <hr>
        <a class="active" href="{{ url('index-admin') }}" data-url="{{ url('index-admin') }}" class="ajax-link"><i class="bi bi-house-door"></i>Home</a>

        <a href="#"><i class="" id="dashboard"></i>Dashboard</a>
        <a href="#" data-url="{{ url('admin-consulta-alumnos') }}" class="ajax-link"><i class=""></i>Alumnos</a>
        <a data-url="{{ url('admin-consulta-maestros') }}" class="ajax-link"><i class=""></i>Maestros</a>
        <a href="#"><i class=""></i>Guardias</a>
        <a href="#"><i class=""></i>Departamentos</a>
        <a href="#"><i class=""></i>Peticiones</a>
    </div>


</div>
