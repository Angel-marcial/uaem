/* 
*
*Codice
*Nombre del Código: adminAlumno.js
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
        document.getElementById("divCarreraAlumno").style.display = "none";
        document.getElementById("divCarreras").style.display = "block";
        document.getElementById("numeroCuenta").disabled = false;
        document.getElementById("telefono").disabled = false;
        document.getElementById("nombres").disabled = false;
        document.getElementById("apellidoPaterno").disabled = false;
        document.getElementById("apellidoMaterno").disabled = false;

        document.getElementById("editarAdminAlumno").style.display = "none";
        document.getElementById("guardarAdminAlumno").style.display = "block";
        document.getElementById("cancelarAdminAlumno").style.display = "block";
    };

    window.cancelar = function() 
    {
        document.getElementById("divCarreraAlumno").style.display = "block";
        document.getElementById("divCarreras").style.display = "none";
        document.getElementById("carreraAlumno").disabled = true;
        document.getElementById("numeroCuenta").disabled = true;
        document.getElementById("telefono").disabled = true;
        document.getElementById("nombres").disabled = true;
        document.getElementById("apellidoPaterno").disabled = true;
        document.getElementById("apellidoMaterno").disabled = true;
        
        document.getElementById("editarAdminAlumno").style.display = "block";
        document.getElementById("guardarAdminAlumno").style.display = "none";
        document.getElementById("cancelarAdminAlumno").style.display = "none";  

        location.reload();
    };

    // Asignar eventos a los botones
    document.getElementById("editarAdminAlumno").addEventListener("click", editar);
    document.getElementById("cancelarAdminAlumno").addEventListener("click", cancelar);
});