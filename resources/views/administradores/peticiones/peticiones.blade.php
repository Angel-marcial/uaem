
<!--
    Codice
    Nombre del Código: peticiones.blade.php
    Fecha de Creación: 05/11/2024
    Revisado por: Angel geovanni marcial morales

    Modificaciones:

    Descripción: Este archivo PHP contiene el inicio de las peticiones
-->

@extends('administradores.contenido')

@section('content')

    @if (session('status'))

        @if (!session('error'))
            <div id="divCerrar1" class="alert alert-danger">
                {{ session('status') }}

                <button type="button" class="cerrar"  id="cerrar1" onclick="cerrarMensaje()">X</button>
            </div>
        @else
            <div id="divCerrar2" class="alert alert-success">
                {{ session('status') }}

                <button type="button" class="cerrar"  id="cerrar2" onclick="cerrarMensaje2()">X</button>
            </div>
        @endif

    @else
        <div class="display:none;"></div>

    @endif


    <div class="margenes form-min-size">

        <div class="btn-contenedor">   
            <div class="col-md-7">   
    
                <h5>Datos del Administrador</h5>
            </div>
        </div>
    </div>

@endsection


