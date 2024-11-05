/* 
*
*Codice
*Nombre del Código: validaciones.js
*Fecha de Creación: 14/09/2024 revisado por Angel Geovanni Marcial Morales.
*
*Modificaciones:
*
*Descripción: En este archivo js cuenta con validaciones y restricciones 
para los formularios alumnos,  . 
*/

function validarCuenta(input)
{
    var errorDiv = document.getElementById("divCerrar1");

    if (input.value.length < 7 || input.value.length > 7) 
    {
        errorDiv.style.display = "block";
        errorDiv.textContent = "El número de cuenta debe tener al menos 7 dígitos.";
        return false;
    }else
    {
        errorDiv.style.display = "none";
        errorDiv.textContent = "";
    }
    
}
// Validar que solo se pueda ingresar un dígito del 0 al 9
function validarDigito(input) 
{
    input.value = input.value.replace(/[^0-9]/g, '');
    
    if (input.value.length > 1) 
    {
        input.value = input.value.slice(0, 1);
    }
}

// Validar solo que el numero detelefono acepte 10 dijitos.
function validarTelefono(input)
{
    var errorDiv = document.getElementById("errorDiv");

    input.value = input.value.replace(/\D/g, '');
    
    if (input.value.length > 10) 
    {
        input.value = input.value.slice(0, 10);
    }
}

// Validar textos para los formularios.  
function validarTextos(input)
{
    input.value = input.value.replace(/\d/g, '');

    input.value = input.value
        .toLowerCase()
        .replace(/\b\w/g, function(letra) {
            return letra.toUpperCase();
        });
}

// Validar textos para los apellidos  
function validarTextos2(input)
{
    input.value = input.value.replace(/\d/g, '');

    input.value = input.value
    .toLowerCase()
    .replace(/\b\w/g, function(letra) {
        return letra.toUpperCase();
    });

    const palabras = input.value.split(' ');

    if (input.value === '') 
    {
        errorDiv.style.display = 'block'; // Mostrar el div de error
        errorDiv.innerHTML = "El campo no puede estar vacío."; // Mensaje de error
        input.style.borderColor = 'red';
        return;
    }else if(palabras.length > 2)
    {
        return;
    }else
    {
        errorDiv.style.display = "none";
        errorDiv.textContent = "";
        input.style.borderColor = '#96881B';
    }
}
//validar solo una latra 
function validarMayuscula(input) 
{
    // Convierte el valor a mayúscula
    input.value = input.value.toUpperCase();

    // Expresión regular que solo permite una letra mayúscula
    const regex = /^[A-Z]$/;

    // Verifica si el valor cumple con la expresión regular
    if (!regex.test(input.value)) {
        // Si no cumple, se borra el valor ingresado
        input.value = '';
    }
}

function validarSalon(input) 
{
    if (input.value.length > 3) {
        input.value = input.value.slice(0, 3);
    }
}

/*
function validarTextos(input) 
{
    const errorDiv = document.getElementById('errorDiv');
    // Eliminar cualquier número
    input.value = input.value.replace(/\d/g, '');
    // Eliminar espacios extra al inicio y al final, y reducir múltiples espacios a uno solo


    // Verificar que el campo no esté vacío
    if (input.value === '') 
    {
        errorDiv.style.display = 'block'; // Mostrar el div de error
        errorDiv.innerHTML = "El campo no puede estar vacío."; // Mensaje de error
        input.style.borderColor = 'red';
        return;
    }

    const palabras = input.value.split(' ');

    if (palabras.length > 2) 
    {
        errorDiv.style.display = 'block'; // Mostrar el div de error
        errorDiv.innerHTML = "no puedes ingresar mas de dos palabras"; // Mensaje de error
        return;
    }
    
}
*/
