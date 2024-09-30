<!--
    Codice
    Nombre del Código: index.blade.php
    Fecha de Creación: 27/09/2024 revisado por Jose Angel Monsalvo Cruz

    Modificaciones:

    Descripción: Este archivo PHP contiene el formulario para el inicio de sesion de los usuarios.
-->

@extends('guardias.contenido')

@section('content')

<div class="btn-contenedor ">
    <h1>Bienvenido</h1>
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
                <label for="carrera" class="form-label titulos margenes-contenedor">Carrera</label>
                <label class="form-control text-contenedor btn-contenedor" id="carrera" name="carrera">Carrera</label>
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
