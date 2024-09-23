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
  //$regexMaestro= '/^[\w.-]+@profesor\.uaemex\.mx$/';
  $regexMaestro = '/^[\w.-]++@gmail\.com$/';

  var nombres = form.querySelector('#nombres');
  var paterno = form.querySelector('#apellidoPaterno');
  var materno = form.querySelector('#apellidoMaterno');
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

  //mensajes para las horas 
  //lunes
  if(lunesMensaje != "") 
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
  if(martesMensaje != "") 
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
  if(miercolesMensaje != "") 
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
  if(juevesMensaje != "") 
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
  if(viernesMensaje != "") 
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
  if(sabadoMensaje != "") 
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

  if(horaEntrada < horaMinima)
  {
    return "La hora de entrada debe ser mayor o igual a las 7:00 AM.";
  }

  if(horaEntrada >= (horaMaxima - 60))
  {
    return "La hora de entrada debe ser menor o igual a las 5:00 PM.";
  }

  if(horaSalida > horaMaxima)
  {
    return "La hora de salida debe ser menor o igual a las 6:00 PM.";
  }

  if(horaSalida < (horaMinima + 60))
  {
    return "La hora de salida debe ser mayor o igual a las 8:00 AM.";
  }

  if(horaEntrada >= horaSalida)
  {
    return "la hora de entrada no puede ser mayor a la hora de salida.";
  }

  if(diferenciaHoras(horaEntrada, horaSalida))
  {
    return "El tiempo minimo de permanencia en la univercidad es de 1 hora.";
  }

  return "";

  function convertirHoras(hora) 
  {
    let [horas, minutos] = hora.split(":").map(Number);
    return horas * 60 + minutos;
  }

  function diferenciaHoras(entrada, salida)
  {
    diferencia = salida - entrada;

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

