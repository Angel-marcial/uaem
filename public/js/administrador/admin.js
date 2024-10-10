/* 
*
*Codice
*Nombre del Código: admin.js
*Fecha de Creación: 09/10/2024 revisado por Angel Geovanni Marcial Morales
*
*Modificaciones:
*
*Descripción: Este archivo js cuenta la validacion de los botones 
*/

document.addEventListener('DOMContentLoaded', function() 
{
    // Función para habilitar campos
    window.editar = function() 
    {
        document.getElementById("telefono").disabled = false;
        document.getElementById("nombres").disabled = false;
        document.getElementById("apellidoPaterno").disabled = false;
        document.getElementById("apellidoMaterno").disabled = false;

        document.getElementById("editarAdmin").style.display = "none";
        document.getElementById("guardarAdmin").style.display = "block";
        document.getElementById("cancelarAdmin").style.display = "block";
    };

    window.cancelar = function() 
    {
        document.getElementById("telefono").disabled = true;
        document.getElementById("nombres").disabled = true;
        document.getElementById("apellidoPaterno").disabled = true;
        document.getElementById("apellidoMaterno").disabled = true;
        
        document.getElementById("editarAdmin").style.display = "block";
        document.getElementById("guardarAdmin").style.display = "none";
        document.getElementById("cancelarAdmin").style.display = "none";  

        location.reload();
    };

    // Asignar eventos a los botones
    document.getElementById("editarAdmin").addEventListener("click", editar);
    document.getElementById("cancelarAdmin").addEventListener("click", cancelar);
});