/* 
*
*Codice
*Nombre del Código: guardia.js
*Fecha de Creación: 29/09/2024 revisado por Angel Geovanni Marcial Morales.
*
*Modificaciones:
*
*Descripción: En este archivo js cuenta con validaciones y restricciones 
para la interfaz guardia . 
*/

function onScanSuccess(decodedText, decodedResult) {
    // Muestra el texto decodificado
    document.getElementById('result').innerText = `Código QR detectado: ${decodedText}`;
    document.getElementById('status').innerText = '¡Éxito! Código QR detectado.';

    // Detener la cámara después de detectar un código QR
    html5QrCode.stop().then(() => {
        console.log("Cámara detenida después de detectar el código QR.");
    }).catch((err) => {
        console.error("Error al detener la cámara: ", err);
    });
}

var html5QrCode = new Html5Qrcode("reader");

// Inicia la cámara
html5QrCode.start(
    { facingMode: "user" }, // Usar la cámara frontal. Cambia a "environment" para la cámara trasera
    {
        fps: 10, // Frames por segundo
        qrbox: { width: 200, height: 130 } // Área de escaneo
    },
    onScanSuccess
).then(() => {
    // La cámara se ha iniciado correctamente
    document.getElementById('status').innerText = 'Cámara activa';
}).catch(err => {
    console.error(`Error al iniciar la cámara: ${err}`);
    document.getElementById('status').innerText = 'Error al activar la cámara';
});



