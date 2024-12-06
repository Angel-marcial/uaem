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
let audioPlayed = false; 
let infoEnviada = false;

let selectedOption = 'Ingresos'; 

document.querySelectorAll('input[name="btnradio"]').forEach((radio) => {
    radio.addEventListener('change', (event) => {
        selectedOption = event.target.value;
        console.log('Opción seleccionada:', selectedOption);
    });
});

function onScanSuccess(decodedText, decodedResult) 
{
    const bien = new Audio('/bien.mp3');
    const error = new Audio('/error.mp3');
    const fatal = new Audio('/fatal.mp3');

    //const error = document.getElementById('divCerrar2');
    //const boton = document.getElementById('cerrar2');

    //document.getElementById('carrera').innerText = 'hola';
    // Muestra el texto decodificado
    //document.getElementById('result').innerText = `${decodedText}`;
    //document.getElementById('status').innerText = '¡Éxito! Código QR detectado.';

    //document.getElementById('result').innerText = `${decodedText}`;

    const estatus = document.getElementById('estatus');
    const numeroCuenta = document.getElementById('numeroCuenta');
    const carrera = document.getElementById('carrera');
    
    //extraer datos. 
    const resultText = decodedText;

    try 
    {
        carrera.style.backgroundColor = "";
        numeroCuenta .style.backgroundColor = "";


        const idQr = resultText.match(/Id:\s*(\d+)/)[1];
        const nombreQr = resultText.match(/Nombre:\s*(.*)/)[1];
        const noCuentaQr = resultText.match(/No\. Cuenta:\s*(\d+)/)[1];
        const statusQr = resultText.match(/Status:\s*(\w+)/)[1];
        const rolQr = resultText.match(/Rol:\s*(\w+)/)[1];
        const fechaQr = resultText.match(/Fecha:\s*(\d{2}\/\d{2}\/\d{4})/)[1];
        const horaQr = resultText.match(/Hora:\s*(\d{2}:\d{2}:\d{2})/)[1];
        
        const hoy = new Date();
        //horas
        const horas = hoy.getHours().toString().padStart(2, '0'); // Asegura que tenga 2 dígitos
        const minutos = hoy.getMinutes().toString().padStart(2, '0'); // Asegura que tenga 2 dígitos
        const segundos = hoy.getSeconds().toString().padStart(2, '0');

        const hora = horas +":"+ minutos +":"+segundos;

        //fecha dia/mes/año
        const dia = hoy.getDate().toString().padStart(2, '0'); 
        const mes = (hoy.getMonth() + 1).toString().padStart(2, '0');
        const anio = hoy.getFullYear();
        //dias
        const diasDeLaSemana = ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"];
        const diaDeLaSemana = diasDeLaSemana[hoy.getDay()];
       
        // Formatear la fecha en formato día/mes/año
        const fechaFormateada = `${dia}/${mes}/${anio}`;


        const logMessage = `Id: ${idQr} | Nombre: ${nombreQr} | No. Cuenta: ${noCuentaQr} | Status: ${statusQr} | Rol: ${rolQr} | Fecha: ${fechaQr} | Hora: ${horaQr}`;
        console.log(logMessage);

        if(fechaFormateada === fechaQr && statusQr === "true")
        {
            if (!audioPlayed) 
            {
                bien.play();
                audioPlayed = true; // Marcar como reproducido
            }
            //error.style.display = "none";
            document.getElementById('numeroCuenta').innerText = noCuentaQr;
            document.getElementById('carrera').innerText = rolQr;
            document.getElementById('estatus').innerText = "Permitido";

            estatus.style.backgroundColor = "#60866D";

            if(selectedOption == "Ingresos" && !infoEnviada)
            {

                infoEnviada = true;
                console.log('Opción seleccionada:', selectedOption + ": hola ingreso");


                console.log(`
                    ID: ${idQr}
                    Nombre: ${nombreQr}
                    Número de Cuenta: ${noCuentaQr}
                    Estado: ${statusQr}
                    Rol: ${rolQr}
                    Fecha: ${fechaQr}
                    Hora: ${horaQr}
                  `);
                  
                enviarDatos(selectedOption, idQr, fechaQr, hora, diaDeLaSemana, rolQr);

            }
            else if(selectedOption == "Salidas" && !infoEnviada)
            {
                infoEnviada = true;
                console.log('Opción seleccionada:', selectedOption + ": hola salida");
                enviarDatos(selectedOption, idQr, fechaQr, hora, diaDeLaSemana, rolQr);
            }
        }
        else
        {
            if (!audioPlayed) 
            {
                error.play();
                audioPlayed = true; // Marcar como reproducido
            }
            document.getElementById('numeroCuenta').innerText = noCuentaQr;
            document.getElementById('carrera').innerText = rolQr;
            document.getElementById('estatus').innerText = "No Permitido";
            //error.style.display = "block";
            //error.textContent = "Acceso no permitido.";
            estatus.style.backgroundColor = "#df1010";
        }

    } catch (error) 
    {
        if (!audioPlayed) 
        {
            fatal.play();
            audioPlayed = true; // Marcar como reproducido
        }
        
        document.getElementById('numeroCuenta').innerText = "S/D";
        document.getElementById('carrera').innerText = "S/D";
        document.getElementById('estatus').innerText = "S/D";
        document.getElementById('result').innerText =  `${decodedText}`;  //"ERROR"//'Error al procesar el código QR. contacta con soporte tecnico.';
        
        estatus.style.backgroundColor = "#df1010";
        numeroCuenta .style.backgroundColor = "#df1010";
        carrera.style.backgroundColor = "#df1010";
    }

    setTimeout(() => {
        infoEnviada = false;
        audioPlayed = false; 
    }, 500);
}


var html5QrCode = new Html5Qrcode("reader");

// Inicia la cámara
html5QrCode.start(
    { facingMode: "user" }, // Usar la cámara frontal. Cambia a "environment" para la cámara trasera
    {
        fps: 10, 
        qrbox: { width: 200, height: 130 }
    },
    onScanSuccess
).then(() => {
    // La cámara se ha iniciado correctamente
    document.getElementById('status').innerText = 'Cámara activa';
}).catch(err => {
    console.error(`Error al iniciar la cámara: ${err}`);
    document.getElementById('status').innerText = 'Error al activar la cámara';
});


async function enviarDatos(tipo, id_usuario, fecha, hora_ingreso, dia, rol) 
{
    try {
        const response = await fetch('http://localhost:8000/guardar-entradas-salidas', 
            {
            method: 'POST',
            headers: 
            {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                tipo: tipo,
                id_usuario: id_usuario,
                fecha: fecha,
                hora_ingreso: hora_ingreso,
                dia: dia,
                rol: rol
            })
        });

        if (!response.ok) {
            throw new Error(`Error en la respuesta del servidor: ${response.statusText}`);
        }

        const data = await response.json(); // Opcional: si esperas recibir datos JSON en la respuesta
        console.log('Datos enviados con éxito:', data);
    } catch (error) 
    {
        console.error('Error al enviar los datos:', error);
    }
}
