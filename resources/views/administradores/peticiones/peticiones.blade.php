
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


    <div class="margenes">

        <h1>Peticiónes</h1>

        @foreach ($peticiones as $peticion)

        <div class="card">
            <div class="card-header">
                {{ $peticion->nombre_completo }}
                <span class="float-end">Fecha: {{ $peticion->fecha_visita }} </span> <!-- Fecha alineada a la derecha -->
            </div>
            <div class="card-body">
                <h4 class="card-title">{{ $peticion->motivo}}</h4>
                <h6 class="card-text">Datos de contacto</h6>
                <p class="card-text">Correo: {{$peticion->correo}}</p>
                <p class="card-text">Telefono: {{$peticion->telefono}}</p>
                <p class="card-text">Hora Solicitada: {{$peticion->hora_visita}}</p>

                <div class="d-flex justify-content-end gap-2 btn-contenedor">
                    <a href="#" class="btn btn-success">Aceptar</a>
                    <a href="#" class="btn btn-danger">Rechazar</a>
                </div>
                
            </div>
        </div>

        <div class="card-vw"></div>
        
        @endforeach
    </div>



@endsection


