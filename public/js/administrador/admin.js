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
        document.getElementById("numeroCuenta").disabled = false;
        document.getElementById("telefono").disabled = false;
        document.getElementById("nombres").disabled = false;
        document.getElementById("apellidoPaterno").disabled = false;
        document.getElementById("apellidoMaterno").disabled = false;
        document.getElementById("correo").disabled = false;
        document.getElementById("password").disabled = false;        

        document.getElementById("editarAdminGuardia").style.display = "none";
        document.getElementById("guardarAdminGuardia").style.display = "block";
        document.getElementById("cancelarAdminGuardia").style.display = "block";
    };

    window.cancelar = function() 
    {
        document.getElementById("numeroCuenta").disabled = true;
        document.getElementById("telefono").disabled = true;
        document.getElementById("nombres").disabled = true;
        document.getElementById("apellidoPaterno").disabled = true;
        document.getElementById("apellidoMaterno").disabled = true;
        document.getElementById("correo").disabled = true;
        document.getElementById("password").disabled = true;
        
        document.getElementById("editarAdminGuardia").style.display = "block";
        document.getElementById("guardarAdminGuardia").style.display = "none";
        document.getElementById("cancelarAdminGuardia").style.display = "none";  

        location.reload();
    };

    // Asignar eventos a los botones
    document.getElementById("editarAdminGuardia").addEventListener("click", editar);
    document.getElementById("cancelarAdminGuardia").addEventListener("click", cancelar);
});

function togglePassword() {
    var passwordField = document.getElementById("password");
    var button = event.currentTarget;
    if (passwordField.type === "password") {
        passwordField.type = "text";
        button.textContent = "Ocultar";
    } else {
        passwordField.type = "password";
        button.textContent = "Mostrar";
    }
}