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
    input.value = input.value.replace(/\D/g, '');
    
    if (input.value.length > 10) 
    {
        input.value = input.value.slice(0, 10);
    }
}

function validarTextos(input)
{
    input.value = input.value.replace(/\d/g, '');

    input.value = input.value
        .toLowerCase()
        .replace(/\b\w/g, function(letra) {
            return letra.toUpperCase();
        });
}