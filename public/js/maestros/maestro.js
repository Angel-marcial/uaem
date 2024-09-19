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

  boton.disabled = true;
  boton.innerText = 'Guardando...';

  return true;
}
