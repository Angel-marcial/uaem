/* 
*
*Codice
*Nombre del Código: alumno.js
*Fecha de Creación: 22/08/2024 revisado por Angel Geovanni Marcial Morales.
*
*Modificaciones:
*
*Descripción: En este archivo js cuenta con las validaciones del formulario alumnos. 
*/

function alumno(form) 
{
    var regexPalabra = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/;
    var regexAlumno = /^[\w.-]+@alumno\.uaemex\.mx$/;
    
    var errorDiv = document.getElementById("errorDiv");
    var carrera = document.getElementById("carreras");

    var cuenta = form.querySelector('#numeroCuenta');
    var nombres = form.querySelector('#nombres');
    var paterno = form.querySelector('#apellidoPaterno');
    var materno = form.querySelector('#apellidoMaterno');
    var telefono = form.querySelector('#telefono');
    var boton = form.querySelector('#guardar');

    //numero de cuenta
    if (cuenta.value.length < 7 || cuenta.value.length > 7) 
    {
        errorDiv.style.display = "block";
        errorDiv.textContent = "El número de cuenta debe tener al menos 7 dígitos.";
        return false;

    }else
    {
        errorDiv.style.display = "none";
        errorDiv.textContent = "";
    }

    //nombre del alumno
    validarNombres(nombres);

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

    boton.disabled = true;
    boton.innerText = 'Guardando...';

    return true;
}

function validarNombres(input)
{
    var errorDiv = document.getElementById("errorDiv");
    var regexPalabra = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/;


    if(!regexPalabra.test(input.value))
    {
        errorDiv.style.display = "block";
        errorDiv.textContent = "El nombre solo puede contener letras.";
        input.style.borderColor = 'red';
        return false;

    }else
    {
        errorDiv.style.display = "none";
        errorDiv.textContent = "";
        input.style.borderColor = '#96881B';
    }
}

