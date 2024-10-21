function validarCorreo(input) {
    // Expresión regular para validar la estructura del correo
    const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    const dominiosPermitidos = [
        'gmail.com', 'yahoo.com', 'hotmail.com', 'outlook.com', 
        'live.com', 'icloud.com', 'mail.com', 'aol.com', 
        'protonmail.com', 'gmx.com', 'zoho.com'
    ];

    const email = input.value;
    const dominio = email.substring(email.lastIndexOf('@') + 1);
    const mensajeValidacion = document.getElementById('mensajeValidacion');

    // Validar estructura del correo con regex
    const cumpleRegex = regex.test(email);

    // Validar si el dominio está en la lista de permitidos
    const cumpleDominio = dominiosPermitidos.includes(dominio);

    // Si cumple al menos una de las dos validaciones
    if (!cumpleRegex && !cumpleDominio) {
        mensajeValidacion.style.display = 'block';
        mensajeValidacion.style.color = '#58151c';
        mensajeValidacion.innerHTML = 'El correo no es válido. Debe tener un formato correcto o pertenecer a un dominio permitido.';
        return false;
    }

    // Si cumple una de las validaciones, ocultar el mensaje de error
    mensajeValidacion.style.display = 'none';
    return true;
}

function establecerMinMaxFecha() {
    const fechaInput = document.getElementById('fecha');
    const hoy = new Date();
    const manana = new Date(hoy);
    manana.setDate(hoy.getDate() + 1); // Establecer el mínimo como el día siguiente al actual

    // Convertir la fecha a formato 'YYYY-MM-DD' para establecer como min
    const year = manana.getFullYear();
    const month = (manana.getMonth() + 1).toString().padStart(2, '0'); // Mes con 2 dígitos
    const day = manana.getDate().toString().padStart(2, '0'); // Día con 2 dígitos

    fechaInput.min = `${year}-${month}-${day}`;

    // Lógica para evitar selección de domingos
    fechaInput.addEventListener('change', function() {
        validarFecha(this);
    });
}

function validarFecha(input) {
    const fechaInput = new Date(input.value + 'T00:00:00');
    const diaSemana = fechaInput.getUTCDay(); // Obtiene el día de la semana (0 = domingo)
    const mensajeValidacion = document.getElementById('mensajeValidacion');

    // Evitar que se seleccionen domingos (día 0)
    if (diaSemana === 0) {
        mensajeValidacion.style.display = 'block';
        mensajeValidacion.style.color = '#58151c';
        mensajeValidacion.innerHTML = 'No se pueden seleccionar domingos.';
        input.value = ''; // Limpiar el campo de fecha
        return false;
    } else {
        mensajeValidacion.style.display = 'none';
        return true;
    }
}

function validarHora(input) {
    const horaInput = input.value;
    const [hora, minuto] = horaInput.split(':');
    const horaEntera = parseInt(hora);

    const mensajeValidacion = document.getElementById('mensajeValidacion');

    if (horaEntera < 7 || horaEntera > 17 || (horaEntera === 17 && minuto !== '00')) {
        mensajeValidacion.style.display = 'block';
        mensajeValidacion.style.color = '#58151c';
        mensajeValidacion.innerHTML = 'Solo se pueden agendar citas entre las 7:00 AM y las 5:00 PM.';
        input.value = ''; 
        return false;
    } else {
        mensajeValidacion.style.display = 'none';
        return true;
    }
}

function validarInvitado(form) {
    const nombreInput = form.nombres;
    const regex = /^[a-zA-ZÀ-ÿ\u00f1\u00d1\s]+$/;
    const mensajeValidacion = document.getElementById('mensajeValidacion');

    if (!regex.test(nombreInput.value)) {
        mensajeValidacion.style.display = 'block';
        mensajeValidacion.style.color = '#58151c';
        mensajeValidacion.innerHTML = 'El nombre solo puede contener letras, acentos y la letra ñ.';
        return false;
    }

    const telefonoInput = form.telefono;
    if (telefonoInput.value.length !== 10) {
        mensajeValidacion.style.display = 'block';
        mensajeValidacion.style.color = '#58151c';
        mensajeValidacion.innerHTML = 'El número de teléfono debe contener exactamente 10 dígitos.';
        return false;
    }

    const horaInput = form.hora;
    if (!validarHora(horaInput)) {
        return false;
    }

    const fechaInput = form.fecha;
    if (!validarFecha(fechaInput)) {
        return false;
    }

    return true;
}

window.onload = function() {
    establecerMinMaxFecha();

    const horaInput = document.getElementById('hora');
    horaInput.addEventListener('change', function() {
        validarHora(this);
    });
}
