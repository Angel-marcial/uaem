
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

        @php
            $date = date('Y-m-d');
        @endphp

        <div class="d-flex align-items-center justify-content-between">
            <h1 class="mb-0">Peticiones</h1>
            
            <div class="btn-group btn-grupo" role="group" aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                <label class="btn btn btn-success" for="btnradio1">Aceptadas</label>
            
                <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                <label class="btn btn btn-success" for="btnradio2">Pendientes</label>
            
                <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
                <label class="btn btn btn-success" for="btnradio3">Rechazadas</label>
            </div>
        </div>

        @foreach ($peticiones as $peticion)

            @if($peticion->fecha_visita >= $date && $peticion->estatus == 0)

                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <div class="col text-start">{{ $peticion->nombre_completo }}</div>
                        <div class="col text-center">Fecha: {{ $peticion->fecha_visita }}</div>
                        <div class="col text-end">Hora: {{ $peticion->hora_visita }}</div>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ $peticion->motivo }}</p>
                        <div class="d-flex justify-content-end gap-2 btn-contenedor">
                            @if( $peticion->estatus == 0 ) <!--invitacion pendiente-->
                                <!--boton aceptar-->
                                <form id="postForm-{{ $peticion->id }}" action="{{ url('enviar-correo-invitacion/'. $peticion->id) }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                <a href="javascript:void(0);" onclick="document.getElementById('postForm-{{ $peticion->id }}').submit();" class="btn btn-success">Aceptar</a>
                                <!--boton rechazar-->
                                <form id="postForm2-{{ $peticion->id }}" action="{{ url('admin-cancela-invitacion/'. $peticion->id) }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                <a href="javascript:void(0);" onclick="document.getElementById('postForm2-{{ $peticion->id }}').submit();" class="btn btn-danger">Rechazar</a>

                            @else
                            
                                <a href="javascript:void(0);" onclick="document.getElementById('postForm-{{ $peticion->id }}').submit();" class="btn btn-success disabled">Aceptar</a>
                            
                            @endif

                        </div>
                    </div>
                    <div class="card-footer text-body-secondary">
                        <p class="card-text">Correo: {{ $peticion->correo }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Teléfono: {{ $peticion->telefono }}</p>
                    </div>
                </div>

            @endif
            
        <div class="card-vw"></div>
    @endforeach

    </div>
</div>

@endsection


