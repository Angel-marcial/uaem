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

            <h5>Datos del Cordinador</h5>

            <div class="contenedor margenes-contenedor">

                <div class="margenes-contenedor">

                    <div class="row g-0">
                        <div class="col-sm-6 col-md-8">

                        </div>
                        <div class="col-6 col-md-4">

                            <div> 
                                <label for="numeroCuenta" class="form-label titulos margenes-contenedor">No de cuenta</label>
                                <label class="form-control text-contenedor btn-contenedor" id="numeroCuenta" name="numeroCuenta"> {{ old('carrera', $usuarios->no_cuenta?? '') }}</label>
                            </div>

                        </div>
                    </div>

                    <div>
                        <label for="nombres" class="form-label titulos margenes-contenedor">Nombres</label>
                        <input type="text" class="form-control text-contenedor" id="nombres" name="nombres" value="{{ old('nombres', $usuarios->nombre ?? '') }}" required disabled oninput="textos(this)">
                    </div>

                    <div>
                        <label for="apellidoPaterno" class="form-label titulos margenes-contenedor">Apellido Paterno</label>
                        <input type="text" class="form-control text-contenedor " id="apellidoPaterno" name="apellidoPaterno" value="{{ old('apellidoPaterno', $usuarios->apellido_paterno ?? '') }}" required disabled oninput="textos(this)">
                    </div>

                    <div>
                        <label for="apellidoMaterno" class="form-label titulos margenes-contenedor">Apellido Materno</label>
                        <input type="text" class="form-control text-contenedor " id="apellidoMaterno" name="apellidoMaterno" value="{{ old('apellidoMaterno', $usuarios->apellido_materno ?? '') }}" required disabled oninput="textos   (this)">
                    </div>

                    <div>
                        <label for="telefono" class="form-label titulos margenes-contenedor">Telefono</label>
                        <input type="number" class="form-control text-contenedor " id="telefono" name="telefono" value="{{ old('telefono', $usuarios->telefono?? '') }}" required disabled oninput="validarTelefono(this)">
                    </div>

                    <div style="text-align: right;">
                        <a href="{{ url('maestros-cuenta') }}" class="btn btn-success btn-editar">
                            CAMBIAR TU INFORMACION
                        </a>
                    </div>

                </div>

            </div>

        </div>
           
    </div>

</div> 





@endsection