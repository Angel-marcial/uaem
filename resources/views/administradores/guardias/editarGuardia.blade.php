<!--
    Codice
    Nombre del Código: editarAlumnos.blade.php
    Fecha de Creación: 10/10/2024
    Revisado por: Jose Angel Monsalvo Cruz

    Modificaciones:

    Descripción: Este archivo PHP contiene la tabla de los alumnos
-->

@extends('administradores.contenido')

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

<div class="margenes">

    <div class="btn-contenedor">   
        <div class="col-md-5">   


            <h5>Datos del Guardia</h5>
            <div class="contenedor margenes-contenedor">  
                
                <form action="{{ url('editar-guardia/'.$guardia->id) }}" method="POST" onsubmit="return editarAlumno(this)">
                    @csrf
                    
                    <div class="margenes-contenedor">

                        <div class="row g-0">
                            <div class="col-sm-6 col-md-8">
                                
                            </div>
                            <div class="col-6 col-md-4">
                                <div> 
                                    <label for="numeroCuenta" class="form-label titulos margenes-contenedor">No de cuenta</label> 
                                    <input type="number" class="form-control text-contenedor btn-contenedor" id="numeroCuenta" name="numeroCuenta" value="{{ old('carrera', $guardia->no_cuenta ?? '') }}" required disabled >
                                </div>

                            </div>
                        </div>

                        <div>
                            <label for="nombres" class="form-label titulos margenes-contenedor">Nombres</label>
                            <input type="text" class="form-control text-contenedor " id="nombres" name="nombres" value="{{ old('nombres', $guardia->nombre ?? '') }}" required disabled oninput="validarTextos(this)">
                        </div>

                        <div>
                            <label for="apellidoPaterno" class="form-label titulos margenes-contenedor">Apellido Paterno</label>
                            <input type="text" class="form-control text-contenedor " id="apellidoPaterno" name="apellidoPaterno" placeholder="Apellido Paterno" value="{{ old('apellidoPaterno', $guardia->apellido_paterno ?? '') }}" required disabled oninput="validarTextos(this)">
                        </div>

                        <div>
                            <label for="apellidoMaterno" class="form-label titulos margenes-contenedor">Apellido Materno</label>
                            <input type="text" class="form-control text-contenedor " id="apellidoMaterno" name="apellidoMaterno" placeholder="Apellido Materno" value="{{ old('apellidoMaterno', $guardia->apellido_materno ?? '') }}" required disabled oninput="validarTextos(this)">
                        </div>

                        <div>
                            <label for="telefono" class="form-label titulos margenes-contenedor">Telefono</label>
                            <input type="number" class="form-control text-contenedor " id="telefono" name="telefono" placeholder="7200000000" value="{{ old('telefono', $guardia->telefono ?? '') }}" required disabled oninput="validarTelefono(this)">
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

