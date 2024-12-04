
<!--
    Codice
    Nombre del Código: indexAdministrador.blade.php
    Fecha de Creación: 08/10/2024
    Revisado por: Jose Angel Monsalvo Cruz

    Modificaciones:

    Descripción: Este archivo PHP contiene el inicio de sesion del administrador
-->



@extends('administradores.contenido')

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

<div class="margenes form-min-size">

    <div class="btn-contenedor">   
        <div class="col-md-7">   

            <h5>Datos del Administrador</h5>

            <div class="contenedor margenes-contenedor">
                <form action="{{ url('editar-admin/'.$admin->id) }}" method="POST" onsubmit="return maestro(this)">
                    @csrf
                    <div class="margenes-contenedor">

                        <div class="row g-0">
                            <div class="col-sm-6 col-md-8">

                            </div>
                            <div class="col-6 col-md-4">

                                <div> 
                                    <label for="numeroCuenta" class="form-label titulos margenes-contenedor">No de cuenta</label>
                                    <label class="form-control text-contenedor btn-contenedor" id="numeroCuenta" name="numeroCuenta" maxlength="7"> {{ old('numeroCuenta', $admin->no_cuenta?? '') }} </label>
                                </div>

                            </div>
                        </div>

                        <div>
                            <label for="nombres" class="form-label titulos margenes-contenedor">Nombres</label>
                            <input type="text" class="form-control text-contenedor" id="nombres" name="nombres" value="{{ old('nombres', $admin->nombre ?? '') }}" required disabled oninput="textos(this)" maxlength="20">
                        </div>

                        <div>
                            <label for="apellidoPaterno" class="form-label titulos margenes-contenedor">Apellido Paterno</label>
                            <input type="text" class="form-control text-contenedor " id="apellidoPaterno" name="apellidoPaterno" value="{{ old('apellidoPaterno', $admin->apellido_paterno ?? '') }}" required disabled oninput="textos(this)" maxlength="20">
                        </div>

                        <div>
                            <label for="apellidoMaterno" class="form-label titulos margenes-contenedor">Apellido Materno</label>
                            <input type="text" class="form-control text-contenedor " id="apellidoMaterno" name="apellidoMaterno" value="{{ old('apellidoMaterno', $admin->apellido_materno ?? '') }}" required disabled oninput="textos(this)" maxlength="20">
                        </div>

                        <div>
                            <label for="telefono" class="form-label titulos margenes-contenedor">Telefono</label>
                            <input type="number" class="form-control text-contenedor " id="telefono" name="telefono" value="{{ old('telefono', $admin->telefono?? '') }}" required disabled oninput="validarTelefono(this)">
                        </div>

                        <div>
                            <label for="correo" class="form-label titulos margenes-contenedor">Correo</label>
                            <input type="email" class="form-control text-contenedor " id="correo" name="correo" value="{{ old('correo', $adminCredencial->correo?? '') }}" required disabled>
                        </div>

                        <div>
                            <label for="password" class="form-label titulos margenes-contenedor">Contraseña</label>
                            <div class="input-group">
                                <input type="password" class="form-control text-contenedor" id="password" name="password" value="{{ old('password', $adminCredencial->password ?? '') }}" required disabled maxlength="10">
                                <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">Mostrar</button>
                            </div>
                        </div>

                        
                        <div class="d-flex justify-content-end gap-2 btn-contenedor">
                            <button type="button" class="btn-editar" id="editarAdminGuardia">Editar</button>
                            <button type="submit" class="btn-custom" id="guardarAdminGuardia" style="display: none;">Guardar</button>
                            <button type="button" class="btn-cancelar" id="cancelarAdminGuardia" style="display: none;">Cancelar</button>
                        </div>

                    </div>

                </form>

            </div>

        </div>


    </div> 
</div>

@endsection

