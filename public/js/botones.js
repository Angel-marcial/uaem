/* 
*
*Codice
*Nombre del Código: botones.js
*Fecha de Creación: 22/08/2024 revisado por Angel Geovanni Marcial Morales.
*
*Modificaciones:
*
*Descripción: En este archivo js cuenta con el bloque de los botones de los formularios . 
*/
function deshabilitarBotonCorreo(form) {
    var boton = form.querySelector('#verificar');

    boton.disabled = true;
    boton.innerText = 'Enviando...';

    return true;
}

function deshabilitarBotonCodigo(form) {
    var boton = form.querySelector('#validar');

    boton.disabled = true;
    boton.innerText = 'Validando...'; 

    return true;
}

function deshabilitarBotonGuardar(form) {
    var boton = form.querySelector('#guardar');

    boton.disabled = true;
    boton.innerText = 'Guardando...'; 

    return true;
}