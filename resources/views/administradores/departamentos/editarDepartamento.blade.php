<!--
    Codice
    Nombre del Código: editarDepartamento.blade.php
    Fecha de Creación: 29/10/2024
    Revisado por: Angel Geovanni Marcial Morales

    Modificaciones:

    Descripción: Este archivo PHP contiene el formulario para editar un departamento. 
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

    <div class="margenes">

        <div class="btn-contenedor">   
            <div class="col-md-5">   

                <h5 >Editar Departamento</h5>
                <div class="contenedor margenes-contenedor">

                    <form action="{{ url('admin-edita-departamento/'.$departamento->id_departamento.'/'.$departamento->id_usuario) }}" method="POST" >
                        @csrf

                        <div class="margenes-contenedor">

                            <div class="row g-0 ">
                                <div class="col-sm-6 col-md-6">

                                </div>

                                <div class="col-6 col-md-6">

                                    <div>
                                        <label for="aula" class="form-label titulos margenes-contenedor">No de Cuenta Del Cordinador </label>
                                        <input type="text" class="form-control text-contenedor " id="numeroCuenta" name="numeroCuenta"  value="{{ old('numeroCuenta', $departamento->no_cuenta ?? '') }}" required disabled oninput="validarCuenta(this)">
                                    </div>

                                </div>
                            </div>

                            <div>
                                <label for="departamento" class="form-label titulos margenes-contenedor">Nombre del Departamento</label>
                                <input type="text" class="form-control text-contenedor " id="departamento" name="departamento" placeholder="Nombre del Departamento" value="{{ old('departamento', $departamento->nombre_departamento ?? '') }}" required disabled oninput="validarTextos2(this)">
                            </div>
           
                            <div class="row g-0 ">
                                <div class="col-sm-6 col-md-6">

                                    <div>
                                        <label for="edificio" class="form-label titulos margenes-contenedor">Edificio</label>
                                        <input type="text" class="form-control text-contenedor " id="edificio" name="edificio" placeholder="Edificio" value="{{ old('edificio', $departamento->edificio ?? '') }}" required disabled oninput="validarMayuscula(this)" maxlength="1">
                                    </div>

                                </div>

                                <div class="col-6 col-md-6">

                                    <div>
                                        <label for="aula" class="form-label titulos margenes-contenedor">Aula</label>
                                        <input type="number" class="form-control text-contenedor " id="aula" name="aula" placeholder="aula" value="{{ old('aula', $departamento->aula ?? '') }}" required disabled oninput="validarSalon(this)" maxlength="3">
                                    </div>

                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2 btn-contenedor">
                                <button type="button" class="btn-editar" id="editarAdminDepartamento">Editar</button>
                                <button type="submit" class="btn-custom" id="guardarAdminDepartamento" style="display: none;">Guardar</button>
                                <button type="button" class="btn-cancelar" id="cancelarAdminDepartamento" style="display: none;">Cancelar</button>
                            </div>

                        </div>

                    </form>

                </div>
            
            </div>
        </div>    

    </div>
        
@endsection





