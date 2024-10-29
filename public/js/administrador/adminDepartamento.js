/* 
*
*Codice
*Nombre del Código: adminDepartamento.js
*Fecha de Creación: 29/10/2024 revisado por Angel Geovanni Marcial Morales
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
        document.getElementById("numeroCuenta").disabled = false;
        document.getElementById("departamento").disabled = false;
        document.getElementById("edificio").disabled = false;
        document.getElementById("aula").disabled = false;


        document.getElementById("editarAdminDepartamento").style.display = "none";
        document.getElementById("guardarAdminDepartamento").style.display = "block";
        document.getElementById("cancelarAdminDepartamento").style.display = "block";
    };

    window.cancelar = function() 
    {
        document.getElementById("numeroCuenta").disabled = true;
        document.getElementById("departamento").disabled = true;
        document.getElementById("edificio").disabled = true;
        document.getElementById("aula").disabled = true;
        
        document.getElementById("editarAdminDepartamento").style.display = "block";
        document.getElementById("guardarAdminDepartamento").style.display = "none";
        document.getElementById("cancelarAdminDepartamento").style.display = "none";  

        location.reload();
    };

    // Asignar eventos a los botones
    document.getElementById("editarAdminDepartamento").addEventListener("click", editar);
    document.getElementById("cancelarAdminDepartamento").addEventListener("click", cancelar);
});