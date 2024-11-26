<!--
    Codice
    Nombre del Código: index.blade.php
    Fecha de Creación: 27/09/2024 revisado por Jose Angel Monsalvo Cruz

    Modificaciones:

    Descripción: Este archivo PHP contiene el formulario para el inicio de sesion de los usuarios.
-->

@extends('guardias.contenido')

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


    <div class="btn-contenedor2">
        <h1 class="bienvenido-texto2">Bienvenido</h1>

        <div class="btn-group btn-grupo2" role="group" aria-label="Basic radio toggle button group">
            <input type="radio" class="btn-check" name="btnradio" id="btnradio1" value="Ingresos" autocomplete="off" checked>
            <label class="btn btn-success" for="btnradio1">Ingresos</label>
        
            <input type="radio" class="btn-check" name="btnradio" id="btnradio2" value="Salidas" autocomplete="off">
            <label class="btn btn-success" for="btnradio2">Salidas</label>
        </div>
    </div>

    <div class="margenes-grandes">

        <div class="row g-0">

            <div class="col-sm-6 col-md-6">

                <div class="reader" id="reader"></div>
                <div id="result"></div>
                <div class="fuente" id="status">Iniciando cámara...</div> <!-- Mensaje de estado -->

            </div>
            
            <div class="col-6 col-md-6">
        
                <div> 
                    <label for="numeroCuenta" class="form-label titulos margenes-contenedor">No de cuenta</label>
                    <label class="form-control text-contenedor btn-contenedor" id="numeroCuenta" name="numeroCuenta">Numero de Cuenta</label>
                </div>

                <div> 
                    <label for="carrera" class="form-label titulos margenes-contenedor">Rol</label>
                    <label class="form-control text-contenedor btn-contenedor" id="carrera" name="carrera">Rol</label>
                </div>

                <div> 
                    <label for="estatus" class="form-label titulos margenes-contenedor">Estatus</label>
                    <label class="form-control text-contenedor btn-contenedor" id="estatus" name="estatus">Estatus</label>
                </div>
        
            </div>

        </div>

    </div>






<!--

<h1>Acceso a la Cámara</h1>
<video id="video" width="500" height="500" autoplay></video>
<div id="status"></div>

<script>
    async function startCamera() {
        try {
            // Configuración para la cámara
            const constraints = {
                video: {
                    facingMode: "user", // Cambia a "environment" si quieres la cámara trasera
                    width: { ideal: 1280 },
                    height: { ideal: 720 }
                }
            };

            // Solicita acceso a la cámara
            const stream = await navigator.mediaDevices.getUserMedia(constraints);
            document.getElementById('video').srcObject = stream;
            document.getElementById('status').innerText = 'Cámara activa';
        } catch (error) {
            console.error("Error al acceder a la cámara: ", error);
            document.getElementById('status').innerText = 'Error al acceder a la cámara. Asegúrate de que los permisos estén otorgados.';
        }
    }

    // Verifica si la API getUserMedia está soportada
    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        startCamera();
    } else {
        console.error("La API getUserMedia no está soportada por este navegador.");
        document.getElementById('status').innerText = 'La API getUserMedia no está soportada por este navegador.';
    }
</script>

-->

@endsection
