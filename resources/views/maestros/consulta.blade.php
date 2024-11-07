<!--
    Codice
    Nombre del Código: contenido.blade.php
    Fecha de Creación: 04/10/2024 revisado por Angel Geovanni Marcial Morales

    Modificaciones:

    Descripción: Este archivo PHP contiene lainformacion del maestro
-->

@extends('maestros.contenido')

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

            <h5>Datos del Profesor</h5>

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
                                    <label class="form-control text-contenedor btn-contenedor" id="numeroCuenta" name="numeroCuenta"> {{ old('carrera', $maestro->no_cuenta?? '') }}</label>
                                </div>

                            </div>
                        </div>

                        <div>
                            <label for="nombres" class="form-label titulos margenes-contenedor">Nombres</label>
                            <input type="text" class="form-control text-contenedor" id="nombres" name="nombres" value="{{ old('nombres', $maestro->nombre ?? '') }}" required disabled oninput="textos(this)">
                        </div>

                        <div>
                            <label for="apellidoPaterno" class="form-label titulos margenes-contenedor">Apellido Paterno</label>
                            <input type="text" class="form-control text-contenedor " id="apellidoPaterno" name="apellidoPaterno" value="{{ old('apellidoPaterno', $maestro->apellido_paterno ?? '') }}" required disabled oninput="textos(this)">
                        </div>

                        <div>
                            <label for="apellidoMaterno" class="form-label titulos margenes-contenedor">Apellido Materno</label>
                            <input type="text" class="form-control text-contenedor " id="apellidoMaterno" name="apellidoMaterno" value="{{ old('apellidoMaterno', $maestro->apellido_materno ?? '') }}" required disabled oninput="textos   (this)">
                        </div>

                        <div>
                            <label for="telefono" class="form-label titulos margenes-contenedor">Telefono</label>
                            <input type="number" class="form-control text-contenedor " id="telefono" name="telefono" value="{{ old('telefono', $maestro->telefono?? '') }}" required disabled oninput="validarTelefono(this)">
                        </div>

                        <div>
                            <button class="btn btn-success">CAMBIAR TU INFORMACION</button>
                        </div>
                    </div>

                </form>

            </div>

        </div>
    </div>

</div> 





@endsection