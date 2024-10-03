/* 
*
*Codice
*Nombre del Código: login.js
*Fecha de Creación: 30/09/2024 revisado por Angel Geovanni Marcial Morales.
*
*Modificaciones:
*
*Descripción: En este archivo js cuenta con validaciones y restricciones 
para el login. 
*/

function login(form)
{
    var errorDiv = document.getElementById("errorDiv");
    var regexMaestro= /^[\w.-]+@profesor\.uaemex\.mx$/;
    var regexAlumno = /^[\w.-]+@alumno\.uaemex\.mx$/;
    var regexgmail = /^[\w.-]+@gmail\.com$/;
    var regexpassword = /^[a-zA-Z0-9]+$/;
    var correo = form.querySelector('#correo');
    var password = form.querySelector('#contra');
    var boton = form.querySelector('#verificar');

    //correo
    if(!regexAlumno.test(correo.value) && !regexMaestro.test(correo.value) && !regexgmail.test(correo.value))
    {
      errorDiv.style.display = "block";
      errorDiv.textContent = "El correo proporcionado no es valido: " + correo.value;
      return false;
    }
    else
    {
      errorDiv.style.display = "none";
      errorDiv.textContent = "";
    }

    //
    if(!regexpassword.test(password.value))
    {
        errorDiv.style.display = "block";
        errorDiv.textContent = "La contraseña no cumple con el formato adecuado";
        return false;
    }
    else
    {
        errorDiv.style.display = "none";
        errorDiv.textContent = "";
    }
    //tamaño contraseña 
    if(password.value.length !== 10)
    {
        errorDiv.style.display = "block";
        errorDiv.textContent = "La contraseña no cumple con el formato adecuado";
        return false;
    }
    else
    {
        errorDiv.style.display = "none";
        errorDiv.textContent = "";
    }

    boton.disabled = true;
    boton.innerText = 'Verificando...';


    setTimeout(function() {
        form.reset();
        boton.disabled = false; 
        boton.innerText = 'Iniciar Sesión'; 
        errorDiv.style.display = "none";
        errorDiv.textContent = "";
    }, 2000); 

    return true;
}






