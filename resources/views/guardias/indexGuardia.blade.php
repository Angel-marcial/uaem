<!--
    Codice
    Nombre del Código: index.blade.php
    Fecha de Creación: 27/09/2024 revisado por Jose Angel Monsalvo Cruz

    Modificaciones:

    Descripción: Este archivo PHP contiene el formulario para el inicio de sesion de los usuarios.
-->

@extends('guardias.contenido')

@section('content')




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

@endsection