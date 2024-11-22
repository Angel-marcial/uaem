<!--
    Codice
    Nombre del Código: indexCoordinador.blade.php
    Fecha de Creación: 21/11/2024 revisado por Angel Geovanni Marcial Morales

    Modificaciones:

    Descripción: Este archivo PHP contiene lainformacion del cordinador
-->

@extends('coordinadores.contenido')

@section('content')

    @if (session('status'))

        @if (!session('error'))
            <div id="divCerrar1" class="alert alert-danger">
                {{ session('status') }}

                <button type="button" class="cerrar"  id="cerrar1" onclick="cerrarMensaje()">X</button>
            </div>
        @else
            <div id="divCerrar2" class="alert alert-success">
                {{ session('status') }}

                <button type="button" class="cerrar"  id="cerrar2" onclick="cerrarMensaje2()">X</button>
            </div>
        @endif

    @else

        <div class="display:none;"></div>

    @endif

    <div class="btn-contenedor">   
        <div class="col-md-7">   
    
            <h5>ACTUALIZAR INFORMACIÓN</h5>
    
            <div class="contenedor margenes-contenedor">
                <form  action="{{ url('editar-cuenta') }}" method="POST" onsubmit="return cordinadores(this)">
                    @csrf
                    <div class="margenes-contenedor">
    
                        <div class="row g-0">
                            <div class="col-sm-6 col-md-8">
    
                            </div>
                            <div class="col-6 col-md-4">
                                <div> 
                                    <label for="numeroCuenta" class="form-label titulos margenes-contenedor">No de cuenta</label>
                                    <label class="form-control text-contenedor btn-contenedor" id="numeroCuenta" name="numeroCuenta"> {{ old('carrera', $cordinadores->no_cuenta ?? '') }}</label>
                                </div>
                            </div>
                        </div>
    
                        <div>
                            <label for="nombres" class="form-label titulos margenes-contenedor">Nombres</label>
                            <input type="text" class="form-control text-contenedor" id="nombres" name="nombres" value="{{ old('nombres', $cordinadores->nombre ?? '') }}" required disabled oninput="textos(this)">
                        </div>
    
                        <div>
                            <label for="apellidoPaterno" class="form-label titulos margenes-contenedor">Apellido Paterno</label>
                            <input type="text" class="form-control text-contenedor" id="apellidoPaterno" name="apellidoPaterno" value="{{ old('apellidoPaterno', $cordinadores->apellido_paterno ?? '') }}" required disabled oninput="textos(this)">
                        </div>
    
                        <div>
                            <label for="apellidoMaterno" class="form-label titulos margenes-contenedor">Apellido Materno</label>
                            <input type="text" class="form-control text-contenedor" id="apellidoMaterno" name="apellidoMaterno" value="{{ old('apellidoMaterno', $cordinadores->apellido_materno ?? '') }}" required disabled oninput="textos(this)">
                        </div>
    
                        <div>
                            <label for="telefono" class="form-label titulos margenes-contenedor">Teléfono</label>
                            <input type="number" class="form-control text-contenedor" id="telefono" name="telefono" value="{{ old('telefono', $cordinadores->telefono ?? '') }}" required disabled oninput="validarTelefono(this)">
                        </div>
    
                        <div>
                            <label for="correo" class="form-label titulos margenes-contenedor">Correo</label>
                            <input type="email" class="form-control text-contenedor" id="correo" name="correo" value="{{ old('correo', $cordinadores->correo ?? '') }}" required disabled>
                        </div>
    
                        <div>
                            <label for="password" class="form-label titulos margenes-contenedor">Contraseña</label>
                            <div class="input-group">
                                <input type="password" class="form-control text-contenedor" id="password" name="password" value="{{ old('password', $cordinadores->password ?? '') }}" required disabled>
                                <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">Mostrar</button>
                            </div>
                        </div>
    
                        <div class="mt-3">
                            <!-- Botón para habilitar los campos de edición -->
                            <button type="button" class="btn btn-warning" onclick="habilitarEdicion()">Editar</button>
                            <!-- Botón para guardar los cambios -->
                            <button type="submit" class="btn btn-success" id="guardarBtn" style="display: none;">Guardar Cambios</button>
                        </div>
    
                    </div>
                </form>
            </div>
    
        </div>
    </div>
    
    <script>
        // Función para habilitar los campos de edición
        function habilitarEdicion() {
            document.getElementById('nombres').disabled = false;
            document.getElementById('apellidoPaterno').disabled = false;
            document.getElementById('apellidoMaterno').disabled = false;
            document.getElementById('telefono').disabled = false;
            document.getElementById('correo').disabled = false;
            document.getElementById('password').disabled = false;
            
            // Muestra el botón de "Guardar Cambios"
            document.getElementById('guardarBtn').style.display = 'inline-block';
        }
    
        // Función para mostrar/ocultar la contraseña
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
    </script>
@endsection