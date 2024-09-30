/* 
*
*Codice
*Nombre del Código: correo.js
*Fecha de Creación: 18/09/2024 revisado por Angel Geovanni Marcial Morales.
*
*Modificaciones:
*
*Descripción: En este archivo js cuenta con validaciones y restricciones 
para los formularios correo de la interafaz maestros  . 
*/
function ValidarCorro(form)
{
    var errorDiv = document.getElementById("errorDiv");
    //$regexMaestro= '/^[\w.-]+@profesor\.uaemex\.mx$/';
    var regexMaestro = /^[\w.-]+@gmail\.com$/;
    var correo = form.querySelector('#correo');
    var boton = form.querySelector('#verificar');

    //correo del maestro
    if(!regexMaestro.test(correo.value))
    {
      errorDiv.style.display = "block";
      errorDiv.textContent = "El correo proporcionado no es valido: " + correo.value;
      return false;
  
    }else
    {
      errorDiv.style.display = "none";
      errorDiv.textContent = "";
    }

    boton.disabled = true;
    boton.innerText = 'Enviando...';

    return true;
}