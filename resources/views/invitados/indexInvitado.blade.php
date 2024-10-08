<!--
    Codice
    Nombre del Código: indexInvitado.blade.php
    Fecha de Creación: 10/09/2024 revisado por Angel Geovanni Marcial Morales

    Modificaciones:

    Descripción: Este archivo PHP contiene el formulario de nuevos invitados en la interfaz invitados.
-->
@extends('invitados.contenido')

@section('content')

<div class="margenes-contenedor">

    @if (session('status'))

        @if (session('correoEnviado') || session('codigoAprobado'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @else
            <div class="alert alert-danger">
                {{ session('status') }}
            </div>
        @endif

    @else

        <div class="alert alert-danger" id="errorDiv" style="display:none;">
            <!--<button type="submit" class="btn-custom " id="cancelar">X</button>-->
        </div>

    @endif

<div class="margenes-contenedor">

    <div class="btn-contenedor">   
        <div class="col-md-5">
            <h5 class="">Datos</h5>
            <div class="contenedor margenes-contenedor">
                
                <form action="" method="POST" onsubmit="return validarInvitado(this)">
                    @csrf

                    <div class="row g-0 btn-contenedor margenes-contenedor">

                        <input type="hidden" name="redirectRoute" value="{{ url('index-invitado') }}">

                        <div>
                            <label for="nombres" class="form-label titulos margenes-contenedor">Nombre completo</label>
                            <input type="text" class="form-control text-contenedor" id="nombres" name="nombres" placeholder="Nombre Completo" required oninput="validarInput(this)" onkeydown="return validarTecla(event)">
                        </div>

                        <div>
                            <label for="correo" class="form-label titulos margenes-contenedor">Correo:</label>
                            <input type="email" class="form-control text-contenedor" id="correo" name="correo" placeholder="Ej: usuario@gmail.com" required onkeypress="return validarTeclaCorreo(event)" oninput="validarCorreo(this)">
                        </div>

                        <div>
                            <label for="telefono" class="form-label titulos margenes-contenedor">Teléfono</label>
                            <input type="tel" class="form-control text-contenedor" id="telefono" name="telefono" placeholder="7200000000" required maxlength="10" onkeypress="return validarSoloNumeros(event)">
                            <div id="telefonoError" class="alert alert-warning mt-2" style="display:none;">
                                <i class="fa fa-exclamation-triangle"></i> Ingresa un número válido. El teléfono debe tener exactamente 10 dígitos.
                            </div>
                        </div>

                        <div class="row g-0">
                            <div class="col-sm-6 col-md-8">

                                <label for="area" class="form-label titulos margenes-contenedor">Selecciona el Área a visitar:</label>
                                <select class="form-control text-contenedor btn-contenedor" id="areas" name="areas">
                                    <option value="control-escolar">Control Escolar</option>
                                    <option value="biblioteca">Biblioteca</option>
                                    <option value="auto-acceso">Auto Acceso</option>
                                    <option value="servicio-social">Servicio Social</option>
                                    <option value="cafeteria">Cafetería</option>
                                </select>
                        
                            </div>

                            <div class="col-6 col-md-4">
                        
                                <label for="hora" class="form-label titulos margenes-contenedor">Hora de la visita:</label>
                                <input type="time" class="form-control text-contenedor" id="hora" name="hora" required>
                                <div id="horaError" class="alert alert-warning mt-2" style="display:none;">
                                    <i class="fa fa-exclamation-triangle"></i> Las citas solo están disponibles de 7:00 AM a 5:00 PM.
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="fecha" class="form-label titulos margenes-contenedor">Fecha de la visita</label>
                            <input type="date" class="form-control text-contenedor" id="fecha" name="fecha" required>
                            <div id="fechaError" class="alert alert-warning mt-2" style="display:none;">
                                <i class="fa fa-exclamation-triangle"></i> La fecha seleccionada debe ser el día de hoy o un día después y no puede ser domingo.
                            </div>
                        </div>

                        <div>
                            <label for="motivo" class="form-label titulos margenes-contenedor">Motivo de la visita</label>
                            <textarea class="form-control text-contenedor" id="motivo" name="motivo" placeholder="Escriba el motivo de su visita" rows="3" required></textarea>
                        </div>

                    
                        <div class="btn-contenedor">
                            <button type="submit" class="btn-custom" id="verificar">Verificar</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

</div>

@endsection



<script>
    // Validación de teclas permitidas para el campo de correo (letras, números, guión, guión bajo, punto, arroba)
    function validarTeclaCorreo(e) {
        const charCode = e.keyCode || e.which;
        const char = String.fromCharCode(charCode);

        // Solo permitir letras, números, guión (-), guión bajo (_), punto (.), y arroba (@)
        const regex = /^[a-zA-Z0-9@._-]+$/; 

        if (regex.test(char) || charCode === 8 || charCode === 9 || charCode === 37 || charCode === 39) {
            return true; // Permitir teclas válidas
        }
        
        // Bloquear cualquier otra tecla
        return false;
    }

    // Validación en tiempo real del contenido del input para eliminar caracteres inválidos
    function validarCorreo(input) {
        const regex = /^[a-zA-Z0-9@._-]*$/;
        input.value = input.value.replace(/[^a-zA-Z0-9@._-]/g, '');
    }

    // Validación para permitir solo números en el campo de teléfono
    function validarSoloNumeros(e) {
        const charCode = e.keyCode || e.which;

        // Solo permitir números (0-9)
        if (charCode >= 48 && charCode <= 57) {
            return true; // Permitir números
        }
        
        // Bloquear cualquier otro carácter
        return false;
    }

    // Validación de teclas permitidas (solo letras, letras con acentos, espacios)
    function validarTecla(e) {
        const charCode = e.keyCode || e.which;
        const char = String.fromCharCode(charCode);
        const regex = /^[a-zA-ZÀ-ÿ\u00f1\u00d1\s]*$/; // Letras, acentos, ñ, Ñ y espacio
        if (regex.test(char) || charCode === 8 || charCode === 9 || charCode === 37 || charCode === 39) { // Permitir backspace, tab, flechas izquierda y derecha
            return true;
        }
        return false;
    }

    // Validación en tiempo real del contenido del input para eliminar caracteres inválidos
    function validarInput(input) {
        const regex = /^[a-zA-ZÀ-ÿ\u00f1\u00d1\s]*$/;
        input.value = input.value.replace(/[^a-zA-ZÀ-ÿ\u00f1\u00d1\s]/g, '');
    }

    // Establecer el mínimo y máximo valor permitido para la fecha (el día de hoy y un día después)
    function establecerMinMaxFecha() {
        const fechaInput = document.getElementById('fecha');
        const hoy = new Date();
        const manana = new Date(hoy);
        manana.setDate(hoy.getDate() + 1); // Establecer un día después

        // Formatear las fechas en formato YYYY-MM-DD
        const yearHoy = hoy.getFullYear();
        const monthHoy = (hoy.getMonth() + 1).toString().padStart(2, '0');
        const dayHoy = hoy.getDate().toString().padStart(2, '0');

        const yearManana = manana.getFullYear();
        const monthManana = (manana.getMonth() + 1).toString().padStart(2, '0');
        const dayManana = manana.getDate().toString().padStart(2, '0');

        // Establecer el valor mínimo (hoy) y máximo (mañana)
        fechaInput.min = `${yearHoy}-${monthHoy}-${dayHoy}`;
        fechaInput.max = `${yearManana}-${monthManana}-${dayManana}`;
    }

    // Validación de la fecha: Solo se permite seleccionar hoy o mañana y no puede ser domingo
    function validarFecha(input) {
        const fechaInput = new Date(input.value);
        const hoy = new Date();
        const manana = new Date(hoy);
        manana.setDate(hoy.getDate() + 1); // Añadir un día

        const diaSemana = fechaInput.getDay(); // 0 = Domingo, 1 = Lunes, ..., 6 = Sábado

        const errorDiv = document.getElementById('fechaError');

        // Verificar si la fecha seleccionada es válida (hoy o mañana y no es domingo)
        if (fechaInput < hoy || fechaInput > manana || diaSemana === 0) {
            errorDiv.style.display = 'block';
            return false;
        } else {
            errorDiv.style.display = 'none';
            return true;
        }
    }

    // Llamar la función para establecer el mínimo y máximo en el campo de fecha cuando la página carga
    window.onload = function() {
        establecerMinMaxFecha();
    }

    // Validación final del formulario
    function validarInvitado(form) {
        const nombreInput = form.nombres;
        const regex = /^[a-zA-ZÀ-ÿ\u00f1\u00d1\s]+$/;
        if (!regex.test(nombreInput.value)) {
            alert("El nombre solo puede contener letras, letras con acentos, espacios y la letra ñ.");
            return false;
        }

        // Validación adicional para el campo de teléfono (debe tener 10 dígitos)
        const telefonoInput = form.telefono;
        if (telefonoInput.value.length !== 10) {
            document.getElementById('telefonoError').style.display = 'block';
            return false;
        } else {
            document.getElementById('telefonoError').style.display = 'none';
        }

        // Validación de la hora
        const horaInput = form.hora;
        if (!validarHora(horaInput)) {
            return false;
        }

        // Validación de la fecha
        const fechaInput = form.fecha;
        if (!validarFecha(fechaInput)) {
            return false;
        }

        return true;
    }
</script>
