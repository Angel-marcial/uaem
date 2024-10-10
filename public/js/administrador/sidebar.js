/* 
*
*Codice
*Nombre del Código: sidebar.js
*Fecha de Creación: 09/10/2024 revisado por Angel Geovanni Marcial Morales
*
*Modificaciones:
*
*Descripción: Este archivo js cuenta la validación de los botones 
*/

// Función para manejar el cambio de la clase 'active'
function setActiveLink(link) {
    // Remueve la clase 'active' de todos los enlaces
    document.querySelectorAll('.sidebar a').forEach(item => item.classList.remove('active'));
    // Agrega la clase 'active' al enlace clickeado
    link.classList.add('active');
}

// Delegación de eventos
document.querySelector('.sidebar').addEventListener('click', function(event) {
    const link = event.target.closest('a'); // Obtiene el enlace que fue clickeado
    if (link) {
        setActiveLink(link); // Llama a la función para establecer el enlace activo
    }
});

// También puedes agregar el mismo comportamiento al finalizar la carga de contenido AJAX
function updateActiveLinkOnLoad() {
    const currentUrl = window.location.href; // Obtiene la URL actual
    document.querySelectorAll('.sidebar a').forEach(link => {
        if (link.href === currentUrl) {
            setActiveLink(link); // Marca el enlace activo basado en la URL actual
        }
    });
}

// Llama a esta función después de cargar contenido dinámicamente
updateActiveLinkOnLoad();
