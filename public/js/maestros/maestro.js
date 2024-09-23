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
  var entradaLunes = form.querySelector('#entradaLunes');
  var salidaLunes = form.querySelector('#salidaLunes');

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
  

  var mensaje = validarHoras(entradaLunes.value,salidaLunes.value);

  if(mensaje != "") 
  {
    errorDiv.style.display = "block";
    errorDiv.textContent = mensaje;
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

}

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