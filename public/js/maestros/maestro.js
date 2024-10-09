/* 
*
*Codice
*Nombre del Código: maestros.js
*Fecha de Creación: 18/09/2024 revisado por Angel Geovanni Marcial Morales.
*
*Modificaciones:
*
*Descripción: En este archivo js cuenta con validaciones y restricciones 
para los formularios maestros  . 
*/

function maestro(form)
{
  var regexPalabra = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/;
  var errorDiv = document.getElementById("errorDiv");
  var cuenta = form.querySelector('#numeroCuenta');
  var nombres = form.querySelector('#nombres');
  var paterno = form.querySelector('#apellidoPaterno');
  var materno = form.querySelector('#apellidoMaterno');
  var telefono = form.querySelector('#telefono');
  //lunes
  var entradaLunes = form.querySelector('#entradaLunes');
  var salidaLunes = form.querySelector('#salidaLunes');
  var lunesMensaje = validarHoras(entradaLunes.value,salidaLunes.value);
  //martes
  var entradaMartes = form.querySelector('#entradaMartes');
  var salidaMartes = form.querySelector('#salidaMartes');
  var martesMensaje = validarHoras(entradaMartes.value,salidaMartes.value);
  //miercoles
  var entradaMiercoles = form.querySelector('#entradaMiercoles');
  var salidaMiercoles = form.querySelector('#salidaMiercoles');
  var miercolesMensaje = validarHoras(entradaMiercoles.value,salidaMiercoles.value);
  //jueves
  var entradaJueves = form.querySelector('#entradaJueves');
  var salidaJueves = form.querySelector('#salidaJueves');
  var juevesMensaje = validarHoras(entradaJueves.value,salidaJueves.value);
  //viernes
  var entradaViernes = form.querySelector('#entradaViernes');
  var salidaViernes = form.querySelector('#salidaViernes');
  var viernesMensaje = validarHoras(entradaViernes.value,salidaViernes.value);
  //sabado
  var entradaSabado = form.querySelector('#entradaSabado');
  var salidaSabado = form.querySelector('#salidaSabado');
  var sabadoMensaje = validarHoras(entradaSabado.value,salidaSabado.value);
  var boton = form.querySelector('#guardar');
  
  //numero de cuenta
  if (cuenta.value.length < 7 || cuenta.value.length > 7) 
  {
    errorDiv.style.display = "block";
    errorDiv.textContent = "El número de cuenta debe tener 7 dígitos.";
    return false;

  }else
  {
    errorDiv.style.display = "none";
    errorDiv.textContent = "";
  }

  //nombre del maestro
  if(!regexPalabra.test(nombres.value))
  {
    errorDiv.style.display = "block";
    errorDiv.textContent = "El nombre solo puede contener letras.";
    return false;

  }else
  {
    errorDiv.style.display = "none";
    errorDiv.textContent = "";
  }

  //apellido paterno
  if(!regexPalabra.test(paterno.value))
  {
    errorDiv.style.display = "block";
    errorDiv.textContent = "El apellido paterno solo puede contener letras.";
    return false;

  }else
  {
    errorDiv.style.display = "none";
    errorDiv.textContent = "";
  }
  
  //apellido materno
  if(!regexPalabra.test(materno.value) )
  {
    errorDiv.style.display = "block";
    errorDiv.textContent = "El apellido materno solo puede contener letras.";
    return false;

  }else
  {
    errorDiv.style.display = "none";
    errorDiv.textContent = "";
  }
  //telefono
  if(telefono.value.length !== 10)
  {
    errorDiv.style.display = "block";
    errorDiv.textContent = "El número de teléfono debe tener exactamente 10 dígitos.";
    return false;
  }else
  {
    errorDiv.style.display = "none";
    errorDiv.textContent = "";
  }

  //mensajes para las horas 
  //lunes

  if(lunesMensaje === "vacio")
  {
    errorDiv.style.display = "none";
    errorDiv.textContent = "";
  }
  else if(lunesMensaje != "") 
  {
    errorDiv.style.display = "block";
    errorDiv.textContent = "Lunes: " + lunesMensaje;
    return false;
  }
  else
  {
    errorDiv.style.display = "none";
    errorDiv.textContent = "";
  }
  //martes
  if(martesMensaje === "vacio")
  {
    errorDiv.style.display = "none";
    errorDiv.textContent = "";
  }
  else if(martesMensaje != "") 
  {
    errorDiv.style.display = "block";
    errorDiv.textContent = "Martes: " + martesMensaje;
    return false;
  }
  else
  {
    errorDiv.style.display = "none";
    errorDiv.textContent = "";
  }
  //miercoles
  if(miercolesMensaje === "vacio")
  {
    errorDiv.style.display = "none";
    errorDiv.textContent = "";
  }
  else if(miercolesMensaje != "") 
  {
    errorDiv.style.display = "block";
    errorDiv.textContent = "Miercoles: " + miercolesMensaje;
    return false;
  }
  else
  {
    errorDiv.style.display = "none";
    errorDiv.textContent = "";
  } 
  //jueves
  if(juevesMensaje === "vacio")
  {
    errorDiv.style.display = "none";
    errorDiv.textContent = "";
  } 
  else if(juevesMensaje != "") 
  {
    errorDiv.style.display = "block";
    errorDiv.textContent = "Jueves: " + juevesMensaje;
    return false;
  }
  else
  {
    errorDiv.style.display = "none";
    errorDiv.textContent = "";
  } 

  //viernes
  if(viernesMensaje === "vacio")
  {
    errorDiv.style.display = "none";
    errorDiv.textContent = "";
  }
  else if(viernesMensaje != "") 
  {
    errorDiv.style.display = "block";
    errorDiv.textContent = "Viernes: " + viernesMensaje;
    return false;
  }
  else
  {
    errorDiv.style.display = "none";
    errorDiv.textContent = "";
  } 

  //Sabado
  if(sabadoMensaje === "vacio")
  {
    errorDiv.style.display = "none";
    errorDiv.textContent = "";
  }
  else if(sabadoMensaje != "") 
  {
    errorDiv.style.display = "block";
    errorDiv.textContent = "Sabado: " + sabadoMensaje;
    return false;
  }
  else
  {
    errorDiv.style.display = "none";
    errorDiv.textContent = "";
  } 

  if(lunesMensaje === "vacio" && martesMensaje === "vacio" && miercolesMensaje === "vacio" 
  && juevesMensaje === "vacio" &&  viernesMensaje === "vacio" && sabadoMensaje === "vacio")
  {
    errorDiv.style.display = "block";
    errorDiv.textContent = "No se detecta ningun horario registrado";
    return false;
  }
  else
  {
    errorDiv.style.display = "none";
    errorDiv.textContent = "";
  } 

  boton.disabled = true;
  boton.innerText = 'Guardando...';

  return true;
}

function validarHoras(entrada, salida)
{
  let horaEntrada = convertirHoras(entrada);
  let horaSalida = convertirHoras(salida);

  let horaMinima = convertirHoras("07:00");
  let horaMaxima = convertirHoras("18:00");

  if(horaEntrada === 0 && horaSalida === 0)
  {
    return "vacio";
  }

  if(horaEntrada === 0 && horaSalida !==0)
  {
    return "hora de entrada no detectada";
  }

  if(horaEntrada !== 0 && horaSalida ===0)
  {
    return "hora de salida no detectada";
  }  

  if(horaEntrada < horaMinima)
  {
    return "La hora de entrada debe ser mayor o igual a las 7:00 AM.";
  }

  if(horaEntrada > (horaMaxima - 60))
  {
    return "La hora de entrada debe ser mayor a las 07:00 AM y menor a las 05:00 PM";
  }

  if(horaSalida > horaMaxima)
  {
    return "La hora de salida debe ser menor o igual a las 6:00 PM.";
  }

  if(horaSalida < (horaMinima + 60))
  {
    return "La hora de salida debe ser mayor a la hora de entrada y menor o igual de las 06:00 PM";
  }

  if(horaEntrada >= horaSalida)
  {
    return "la hora de entrada no puede ser mayor o igual a la hora de salida.";
  }

  if(diferenciaHoras(horaEntrada, horaSalida))
  {
    return "El tiempo minimo de permanencia en la univercidad es de 1 hora.";
  }

  return "";

  function convertirHoras(hora) 
  {
    if (!hora) 
    {
      return 0; 
    }

    let [horas, minutos] = hora.split(":").map(Number);
    return horas * 60 + minutos;
  }

  function diferenciaHoras(entrada, salida)
  {
    let diferencia = salida - entrada;

    if(diferencia < 60)
    {
      return true;
    }
    else
    {
      return false;
    }
  }
}

function textos(input) {
  // Remover números
  input.value = input.value.replace(/\d/g, '');

  // Formatear a minúsculas y luego capitalizar la primera letra de cada palabra
  input.value = input.value.toLowerCase().replace(/\b\w/g, function(letra) {
    return letra.toUpperCase();
  });

  // Dividir el input en palabras y limitar a dos
  let palabras = input.value.split(/\s+/).filter(Boolean); // Eliminar espacios extra
  if (palabras.length > 2) {
    palabras = palabras.slice(0, 2); // Solo mantener las dos primeras palabras
    input.value = palabras.join(' '); // Unir palabras en el input de nuevo
  }
}

document.addEventListener('DOMContentLoaded', function() 
{
  
    // Función para habilitar campos
    window.editar = function() 
    {
        //document.getElementById("entradaMartes");
      
        document.getElementById("telefono").disabled = false;
        document.getElementById("nombres").disabled = false;
        document.getElementById("apellidoPaterno").disabled = false;
        document.getElementById("apellidoMaterno").disabled = false;
        document.getElementById("entradaLunes").disabled = false;
        document.getElementById("salidaLunes").disabled = false;
        document.getElementById("entradaMartes").disabled = false;
        document.getElementById("salidaMartes").disabled = false;
        document.getElementById("entradaMiercoles").disabled = false;
        document.getElementById("salidaMiercoles").disabled = false;
        document.getElementById("entradaJueves").disabled = false;
        document.getElementById("salidaJueves").disabled = false;
        document.getElementById("entradaViernes").disabled = false;
        document.getElementById("salidaViernes").disabled = false;
        document.getElementById("entradaSabado").disabled = false;
        document.getElementById("salidaSabado").disabled = false;

        document.getElementById("editarMaestro").style.display = "none";
        document.getElementById("guardarMaestro").style.display = "block";
        document.getElementById("cancelarMaestro").style.display = "block";
    };

    window.cancelar = function() 
    {
        document.getElementById("telefono").disabled = true;
        document.getElementById("nombres").disabled = true;
        document.getElementById("apellidoPaterno").disabled = true;
        document.getElementById("apellidoMaterno").disabled = true;
        document.getElementById("entradaLunes").disabled = true;
        document.getElementById("salidaLunes").disabled = true;
        document.getElementById("entradaMartes").disabled = true;
        document.getElementById("salidaMartes").disabled = true;
        document.getElementById("entradaMiercoles").disabled = true;
        document.getElementById("salidaMiercoles").disabled = true;
        document.getElementById("entradaJueves").disabled = true;
        document.getElementById("salidaJueves").disabled = true;
        document.getElementById("entradaViernes").disabled = true;
        document.getElementById("salidaViernes").disabled = true;
        document.getElementById("entradaSabado").disabled = true;
        document.getElementById("salidaSabado").disabled = true;
        
        document.getElementById("editarMaestro").style.display = "block";
        document.getElementById("guardarMaestro").style.display = "none";
        document.getElementById("cancelarMaestro").style.display = "none";   

        location.reload();
    };

    // Asignar eventos a los botones
    document.getElementById("editarMaestro").addEventListener("click", editar);
    document.getElementById("cancelarMaestro").addEventListener("click", cancelar);
});


