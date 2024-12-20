<!--
    Codice
    Nombre del Código: indexInvitado.blade.php
    Fecha de Creación: 10/09/2024 revisado por Angel Geovanni Marcial Morales

    Modificaciones:

    Descripción: Este archivo PHP contiene el formulario de nuevos invitados en la interfaz invitados.
-->

<?php 

$fecha_actual = date("Y-m-d");

?>
@extends('invitados.contenido')

@section('content')

<div class="margenes-contenedor">

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

    <div class="alert alert-danger" id="mensajeValidacion" style="display:none; color: #58151c;"></div>

    <div class="margenes-contenedor">

        <div class="btn-contenedor">   
            <div class="col-md-5">
                <h5 class="">Datos</h5>
                <div class="contenedor margenes-contenedor">
                    
                    <form action="crear-invitado" method="POST" onsubmit="return validarInvitado(this)">
                        @csrf

                        <div class="row g-0 btn-contenedor margenes-contenedor">

                            <input type="hidden" name="redirectRoute" value="{{ url('index-invitado') }}">

                            <div>
                                <label for="nombres" class="form-label titulos margenes-contenedor">Nombre completo</label>
                                <input type="text" class="form-control text-contenedor" id="nombres" name="nombres" placeholder="Nombre Completo" required value="{{ old('nombres') }}" oninput="validarInput(this)" onkeydown="return validarTecla(event)">
                            </div>

                            <div>
                                <label for="correo" class="form-label titulos margenes-contenedor">Correo:</label>
                                <input type="email" class="form-control text-contenedor" id="correo" name="correo" placeholder="Ej: usuario@gmail.com" required value="{{ old('correo') }}" onkeypress="return validarTeclaCorreo(event)" oninput="validarCorreo(this)">
                            </div>

                            <div>
                                <label for="telefono" class="form-label titulos margenes-contenedor">Teléfono</label>
                                <input type="tel" class="form-control text-contenedor" id="telefono" name="telefono" placeholder="7200000000" required value="{{ old('telefono') }}" maxlength="10" onkeypress="return validarSoloNumeros(event)">
                            </div>

                            <div class="row g-0">
                                <div class="col-sm-6 col-md-8">
                                    <label for="area" class="form-label titulos margenes-contenedor">Selecciona el Área a visitar:</label>
                                    <select class="form-control text-contenedor btn-contenedor" id="areas" name="areas">
                                        @foreach ($departamentos as $departamento)
                                            <option value="{{ $departamento->id }}" {{ old('areas') == $departamento->id ? 'selected' : '' }}>
                                                {{ $departamento->nombre_departamento }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-6 col-md-4">
                                    <label for="hora" class="form-label titulos margenes-contenedor">Hora de la visita:</label>
                                    <input type="time" class="form-control text-contenedor" id="hora" name="hora" required value="{{ old('hora') }}">
                                </div>
                            </div>

                            <div>
                                <label for="fecha" class="form-label titulos margenes-contenedor">Fecha de la visita</label>
                                <input type="date" class="form-control text-contenedor" id="fecha" name="fecha" required value="{{ old('fecha') }}">
                            </div>

                            <div>
                                <label for="motivo" class="form-label titulos margenes-contenedor">Motivo de la visita</label>
                                <textarea class="form-control text-contenedor" id="motivo" name="motivo" placeholder="Escriba el motivo de su visita" rows="3"  maxlength="255" required >{{ old('motivo') }} </textarea>
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


