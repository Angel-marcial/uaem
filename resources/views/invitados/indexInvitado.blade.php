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

        <div class="alert alert-success">
            {{ session('status') }}
        </div>

    @else

        <div class="alert alert-danger" id="errorDiv" style="display:none;"></div>

    @endif

    <div class="alert alert-danger" id="mensajeValidacion" style="display:none; color: #58151c;"></div>

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
                            </div>

                            <div class="row g-0">
                                <div class="col-sm-6 col-md-8">
                                    <label for="area" class="form-label titulos margenes-contenedor">Selecciona el Área a visitar:</label>
                                    <select class="form-control text-contenedor btn-contenedor" id="areas" name="areas">
                                        @foreach ($departamentos as $departamento)
                                            <option value="{{ $departamento->id }}">{{ $departamento->nombre_departamento }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-6 col-md-4">
                                    <label for="hora" class="form-label titulos margenes-contenedor">Hora de la visita:</label>
                                    <input type="time" class="form-control text-contenedor" id="hora" name="hora" required>
                                </div>
                            </div>

                            <div>
                                <label for="fecha" class="form-label titulos margenes-contenedor">Fecha de la visita</label>
                                <input type="date" class="form-control text-contenedor" id="fecha" name="fecha" required>
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

<script src="{{ asset('js/invitados/invitado.js') }}"></script>


