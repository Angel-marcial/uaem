function validarTeclaCorreo(e) {
    const charCode = e.keyCode || e.which;
    const char = String.fromCharCode(charCode);
    const regex = /^[a-zA-Z0-9@._-]+$/; 

    if (regex.test(char) || charCode === 8 || charCode === 9 || charCode === 37 || charCode === 39) {
        return true; 
    }
    return false;
}

function validarCorreo(input) {
    const regex = /^[a-zA-Z0-9@._-]*$/;
    input.value = input.value.replace(/[^a-zA-Z0-9@._-]/g, '');
}

function validarSoloNumeros(e) {
    const charCode = e.keyCode || e.which;
    if (charCode >= 48 && charCode <= 57) {
        return true;
    }
    return false;
}

function validarTecla(e) {
    const charCode = e.keyCode || e.which;
    const char = String.fromCharCode(charCode);
    const regex = /^[a-zA-ZÀ-ÿ\u00f1\u00d1\s]*$/; 
    if (regex.test(char) || charCode === 8 || charCode === 9 || charCode === 37 || charCode === 39) {
        return true;
    }
    return false;
}

function validarInput(input) {
    const regex = /^[a-zA-ZÀ-ÿ\u00f1\u00d1\s]*$/;
    input.value = input.value.replace(/[^a-zA-ZÀ-ÿ\u00f1\u00d1\s]/g, '');
}

function establecerMinMaxFecha() {
    const fechaInput = document.getElementById('fecha');
    const hoy = new Date();
    const manana = new Date(hoy);
    manana.setDate(hoy.getDate() + 1); 

    const yearManana = manana.getFullYear();
    const monthManana = (manana.getMonth() + 1).toString().padStart(2, '0');
    const dayManana = manana.getDate().toString().padStart(2, '0');

    fechaInput.min = `${yearManana}-${monthManana}-${dayManana}`;
    fechaInput.addEventListener('change', function() {
        validarFecha(this);
    });
}

function validarFecha(input) {
    const fechaInput = new Date(input.value + 'T00:00:00');
    const hoy = new Date();
    const manana = new Date(hoy);
    manana.setDate(hoy.getDate() + 1);

    const diaSemana = fechaInput.getUTCDay();
    const mensajeValidacion = document.getElementById('mensajeValidacion');

    if (fechaInput < manana || diaSemana === 0) {  
        mensajeValidacion.style.display = 'block';
        mensajeValidacion.style.color = '#58151c';
        mensajeValidacion.innerHTML = 'No se pueden seleccionar domingos.';
        input.value = ''; 
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

window.onload = function() {
    establecerMinMaxFecha();

    const horaInput = document.getElementById('hora');
    horaInput.addEventListener('change', function() {
        validarHora(this);
    });
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
