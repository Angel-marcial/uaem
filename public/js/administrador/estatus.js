/* 
*
*Codice
*Nombre del Código: estatus.js
*Fecha de Creación: 14/10/2024 revisado por Angel Geovanni Marcial Morales
*
*Modificaciones:
*
*Descripción: Este archivo js cuenta con el cambio de estatus de los alumnos
*/

function toggleEstatus(checkbox, alumnoId) 
{
    const nuevoEstatus = checkbox.checked ? 1 : 0;

    fetch(`actualizar-estatus-alumno/${alumnoId}`, {
        method: 'POST',
        headers: 
        {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}' 
        },
        body: JSON.stringify({
            estatus: nuevoEstatus
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) 
        {
            console.log('Estatus actualizado con éxito');
        } else 
        {

            checkbox.checked = !nuevoEstatus;
            alert('Hubo un error al actualizar el estatus.');
        }
    })
    .catch(error => {

        console.error('Error al actualizar el estatus:', error);
        checkbox.checked = !nuevoEstatus; 
        alert('Error al conectar con el servidor.');
    });
}
