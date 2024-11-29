<!--
    Codice
    @author Vladimir
    Nombre del Código: cuenta.blade.php
    Fecha de Creación: 06/10/2024 revisado por Angel Geovanni Marcial Morales

    Modificaciones:

    Descripción: Este archivo PHP contiene lainformacion del maestro
-->

@extends('maestros.contenido')

@section('content')

<div class="btn-contenedor">   
    <div class="col-md-7">   

        <h5>ACTUALIZAR INFORMACIÓN</h5>

        <div class="contenedor margenes-contenedor">
            <form action="{{ url('editar-maestro/'.$maestro->id) }}" method="POST" onsubmit="return maestro(this)">
                @csrf
                <div class="margenes-contenedor">

                    <div class="row g-0">
                        <div class="col-sm-6 col-md-8">

                        </div>
                        <div class="col-6 col-md-4">
                            <div> 
                                <label for="numeroCuenta" class="form-label titulos margenes-contenedor">No de cuenta</label>
                                <label class="form-control text-contenedor btn-contenedor" id="numeroCuenta" name="numeroCuenta"> {{ old('carrera', $maestro->no_cuenta ?? '') }}</label>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="nombres" class="form-label titulos margenes-contenedor">Nombres</label>
                        <input type="text" 
                               class="form-control text-contenedor" 
                               id="nombres" 
                               name="nombres" 
                               value="{{ old('nombres', $maestro->nombre ?? '') }}" 
                               required 
                               disabled 
                               oninput="validarTexto(this)">
                    </div>
                    
                    <div>
                        <label for="apellidoPaterno" class="form-label titulos margenes-contenedor">Apellido Paterno</label>
                        <input type="text" 
                               class="form-control text-contenedor" 
                               id="apellidoPaterno" 
                               name="apellidoPaterno" 
                               value="{{ old('apellidoPaterno', $maestro->apellido_paterno ?? '') }}" 
                               required 
                               disabled 
                               oninput="validarTexto(this)">
                    </div>
                    
                    <div>
                        <label for="apellidoMaterno" class="form-label titulos margenes-contenedor">Apellido Materno</label>
                        <input type="text" 
                               class="form-control text-contenedor" 
                               id="apellidoMaterno" 
                               name="apellidoMaterno" 
                               value="{{ old('apellidoMaterno', $maestro->apellido_materno ?? '') }}" 
                               required 
                               disabled 
                               oninput="validarTexto(this)">
                    </div>
                    
                    <div>
                        <label for="telefono" class="form-label titulos margenes-contenedor">Teléfono</label>
                        <input type="number" 
                               class="form-control text-contenedor" 
                               id="telefono" 
                               name="telefono" 
                               value="{{ old('telefono', $maestro->telefono ?? '') }}" 
                               required 
                               disabled 
                               oninput="validarTelefono(this)">
                    </div>
                    
                    <div>
                        <label for="correo" class="form-label titulos margenes-contenedor">Correo</label>
                        <input type="email" 
                               class="form-control text-contenedor" 
                               id="correo" 
                               name="correo" 
                               value="{{ old('correo', $maestro->correo ?? '') }}" 
                               required 
                               disabled>
                    </div>
                    
                    <div>
                        <label for="password" class="form-label titulos margenes-contenedor">Contraseña</label>
                        <div class="input-group">
                            <input type="password" 
                                   class="form-control text-contenedor" 
                                   id="password" 
                                   name="password" 
                                   value="{{ old('password', $maestro->password ?? '') }}" 
                                   required 
                                   disabled>
                            <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">Mostrar</button>
                        </div>
                    </div>

                    <div class="mt-3">
                        <!-- Botón para habilitar los campos de edición -->
                        <button type="button" class="btn btn-warning" id="editarBtn" onclick="habilitarEdicion()">Editar</button>
                        <!-- Botón para guardar los cambios -->
                        <button type="submit" class="btn btn-success" id="guardarBtn" style="display: none;">Guardar Cambios</button>
                        <!-- Botón para cancelar los cambios -->
                        <button type="button" class="btn btn-secondary" id="cancelarBtn" style="display: none;" onclick="cancelarEdicion()">Cancelar</button>
                    </div>

                </div>
            </form>
        </div>

    </div>
</div>

<script>
    // Variables para almacenar los valores originales
    let valoresOriginales = {};

    // Función para habilitar los campos de edición
    function habilitarEdicion() {
        // Guardar los valores originales
        valoresOriginales = {
            nombres: document.getElementById('nombres').value,
            apellidoPaterno: document.getElementById('apellidoPaterno').value,
            apellidoMaterno: document.getElementById('apellidoMaterno').value,
            telefono: document.getElementById('telefono').value,
            correo: document.getElementById('correo').value,
            password: document.getElementById('password').value,
        };

        // Habilitar los campos de texto
        document.getElementById('nombres').disabled = false;
        document.getElementById('apellidoPaterno').disabled = false;
        document.getElementById('apellidoMaterno').disabled = false;
        document.getElementById('telefono').disabled = false;
        document.getElementById('correo').disabled = false;
        document.getElementById('password').disabled = false;

        // Mostrar los botones "Guardar Cambios" y "Cancelar"
        document.getElementById('guardarBtn').style.display = 'inline-block';
        document.getElementById('cancelarBtn').style.display = 'inline-block';

        // Ocultar el botón "Editar"
        document.getElementById('editarBtn').style.display = 'none';
    }

    // Función para cancelar la edición y restaurar los valores originales
    function cancelarEdicion() {
        // Restaurar los valores originales en los campos
        document.getElementById('nombres').value = valoresOriginales.nombres;
        document.getElementById('apellidoPaterno').value = valoresOriginales.apellidoPaterno;
        document.getElementById('apellidoMaterno').value = valoresOriginales.apellidoMaterno;
        document.getElementById('telefono').value = valoresOriginales.telefono;
        document.getElementById('correo').value = valoresOriginales.correo;
        document.getElementById('password').value = valoresOriginales.password;

        // Deshabilitar los campos
        document.getElementById('nombres').disabled = true;
        document.getElementById('apellidoPaterno').disabled = true;
        document.getElementById('apellidoMaterno').disabled = true;
        document.getElementById('telefono').disabled = true;
        document.getElementById('correo').disabled = true;
        document.getElementById('password').disabled = true;

        // Ocultar los botones "Guardar Cambios" y "Cancelar"
        document.getElementById('guardarBtn').style.display = 'none';
        document.getElementById('cancelarBtn').style.display = 'none';

        // Mostrar el botón "Editar"
        document.getElementById('editarBtn').style.display = 'inline-block';
    }

    // Validar que solo se ingresen letras en los campos de texto
    function validarTexto(element) {
        const valor = element.value;
        const regex = /^[a-zA-ZÀ-ÿ\s]+$/;
        if (!regex.test(valor)) {
            element.value = valor.replace(/[^a-zA-ZÀ-ÿ\s]/g, "");
        }
    }

    // Validar que el teléfono tenga un máximo de 10 dígitos
    function validarTelefono(element) {
        const valor = element.value;
        const regex = /^[0-9]{0,10}$/;
        if (!regex.test(valor)) {
            element.value = valor.substring(0, 10).replace(/\D/g, "");
        }
    }

        // Función para mostrar/ocultar la contraseña
        function togglePassword() {
        var passwordField = document.getElementById("password");
        if (passwordField.type === "password") {
            passwordField.type = "text";
            event.target.textContent = "Ocultar";
        } else {
            passwordField.type = "password";
            event.target.textContent = "Mostrar";
        }
    }
</script>

@endsection
