<!--

    Codice
    Nombre del Código: nuevoAlumno.blade.php
    Fecha de Creación: 21/10/2024
    Revisado por: Angel Geovanni MArcial Morales

    Modificaciones:

    Descripción: Este archivo PHP contiene el formulario para un nuevo administrador 
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

                <h5 >Datos del Guardia</h5>
                <div class="contenedor margenes-contenedor">
                    
                    <form action="{{ url('admin-alta-guardia') }}" method="POST" >
                        @csrf
                        
                        <div class="margenes-contenedor">

                            <div class="row g-0">
                                <div class="col-sm-6 col-md-8">
                                    
                                </div>
                                <div class="col-6 col-md-4">

                                    <div> 
                                        <label for="numeroCuenta" class="form-label titulos margenes-contenedor">No de cuenta</label>
                                        <input type="number" class="form-control text-contenedor btn-contenedor" id="numeroCuenta" name="numeroCuenta" placeholder="0000000" value="{{ old('numeroCuenta') }}" required>
                                    </div>

                                </div>
                            </div>

                            <div>
                                <label for="nombres" class="form-label titulos margenes-contenedor">Nombres</label>
                                <input type="text" class="form-control text-contenedor " id="nombres" name="nombres" placeholder="Nombres" value="{{ old('nombres') }}" required oninput="validarTextos(this)">
                            </div>

                            <div>
                                <label for="apellidoPaterno" class="form-label titulos margenes-contenedor">Apellido Paterno</label>
                                <input type="text" class="form-control text-contenedor " id="apellidoPaterno" name="apellidoPaterno" placeholder="Apellido Paterno" value="{{ old('apellidoPaterno') }}" required oninput="validarTextos(this)">
                            </div>

                            <div>
                                <label for="apellidoMaterno" class="form-label titulos margenes-contenedor">Apellido Materno</label>
                                <input type="text" class="form-control text-contenedor " id="apellidoMaterno" name="apellidoMaterno" placeholder="Apellido Materno" value="{{ old('apellidoMaterno') }}" required oninput="validarTextos(this)">
                            </div>

                            <div>
                                <label for="telefono" class="form-label titulos margenes-contenedor">Telefono</label>
                                <input type="number" class="form-control text-contenedor " id="telefono" name="telefono" placeholder="7200000000" value="{{ old('telefono') }}" required oninput="validarTelefono(this)">
                            </div>

                            <div>
                                <label for="correo" class="form-label titulos margenes-contenedor">Correo</label>
                                <input type="email" class="form-control text-contenedor " id="correo" name="correo" placeholder="Ej: alumno@alumno.uaemex.mx" value="{{ old('correo') }}" required>
                            </div>

                            <div class="btn-contenedor">
                                <button type="submit" class="btn-custom" id="guardar">Guardar</button>
                            </div>
                        </div>
                        
                    </form>

                </div>

            </div>
        </div>       
    </div>


@endsection