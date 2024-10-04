<!--
    Codice
    Nombre del Código: contenido.blade.php
    Fecha de Creación: 04/10/2024 revisado por Angel Geovanni Marcial Morales

    Modificaciones:

    Descripción: Este archivo PHP contiene lainformacion del maestro
-->

@extends('maestros.contenido')

@section('content')

<div class="margenes-contenedor">

    @if (session('status'))

        @if (session('correoEnviado') || session('codigoAprobado'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @else
            <div class="alert alert-danger">
                {{ session('status') }}
            </div>
        @endif

    @else
    
        <div class="alert alert-danger" id="errorDiv" style="display:none;"></div>
    
    @endif  
 

    <div class="btn-contenedor">   
        <div class="col-md-7">   

            <h5>Datos del Profesor</h5>

            <div class="contenedor margenes-contenedor">
            
                <form action="{{ url('') }}" method="POST" onsubmit="return maestro(this)">
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
                            <input type="text" class="form-control text-contenedor" id="nombres" name="nombres" value="{{ old('nombres', $maestro->nombre ?? '') }}" required disabled oninput="validarTextos(this)">
                        </div>

                        <div>
                            <label for="apellidoPaterno" class="form-label titulos margenes-contenedor">Apellido Paterno</label>
                            <input type="text" class="form-control text-contenedor " id="apellidoPaterno" name="apellidoPaterno" value="{{ old('apellidoPaterno', $maestro->apellido_paterno ?? '') }}" required disabled oninput="validarTextos(this)">
                        </div>

                        <div>
                            <label for="apellidoMaterno" class="form-label titulos margenes-contenedor">Apellido Materno</label>
                            <input type="text" class="form-control text-contenedor " id="apellidoMaterno" name="apellidoMaterno" value="{{ old('apellidoMaterno', $maestro->apellido_materno ?? '') }}" required disabled oninput="validarTextos(this)">
                        </div>

                        <div>
                            <label for="telefono" class="form-label titulos margenes-contenedor">Telefono</label>
                            <input type="number" class="form-control text-contenedor " id="telefono" name="telefono" value="{{ old('telefono', $maestro->telefono?? '') }}" required disabled oninput="validarTelefono(this)">
                        </div>
                        
                        <h5>Horario</h5>
                    
                        <div class="container text-center">
                            <div class="row g-2">

                                <label for="espacio" class="form-label titulos">Lunes:</label>
                                <div class="col-6">
                                    <label for="espacio" class="form-label titulos margenes-contenedor">Entrada:</label>
                                    <div class="">
                                        
                                        <input type="time" class="form-control text-contenedor" id="entradaLunes" name="entradaLunes" value="{{ old('entradaLunes', $horario->entrada_lunes?? '') }}" disabled>

                                    </div>

                                </div>
                                <div class="col-6">
                                    <label for="espacio" class="form-label titulos margenes-contenedor">salida:</label>
                                    <div class="">

                                        <input type="time" class="form-control text-contenedor" id="salidaLunes" name="salidaLunes" value="{{ old('salidaLunes', $horario->salida_lunes?? '') }}" disabled>

                                    </div>
                                </div>
                                
                                <label for="espacio" class="form-label titulos">Martes:</label>
                                <div class="col-6">
                                    <label for="espacio" class="form-label titulos margenes-contenedor">Entrada:</label>
                                    <div class="">

                                        <input type="time" class="form-control text-contenedor" id="entradaMartes" name="entradaMartes" value="{{ old('entradaMartes', $horario->entrada_martes?? '') }}" disabled>
                                    
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="espacio" class="form-label titulos margenes-contenedor">Salida:</label>
                                    <div class="">
                                        <input type="time" class="form-control text-contenedor" id="salidaMartes" name="salidaMartes" value="{{ old('entradaMartes', $horario->salida_martes?? '') }}" disabled>
                                    </div>
                                </div>
                                
                                <label for="espacio" class="form-label titulos">Miercoles:</label>
                                <div class="col-6">
                                    <label for="espacio" class="form-label titulos margenes-contenedor">Entrada:</label>
                                    <div class="">

                                        <input type="time" class="form-control text-contenedor" id="entradaMiercoles" name="entradaMiercoles" value="{{ old('entradaMiercoles', $horario->entrada_miercoles?? '') }}" disabled>
                                    
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="espacio" class="form-label titulos margenes-contenedor">Salida:</label>
                                    <div class="">
                                        <input type="time" class="form-control text-contenedor" id="salidaMiercoles" name="salidaMiercoles" value="{{ old('salidaMiercoles', $horario->salida_miercoles?? '') }}" disabled>
                                    </div>
                                </div>

                                <label for="espacio" class="form-label titulos">Jueves:</label>
                                <div class="col-6">
                                    <label for="espacio" class="form-label titulos margenes-contenedor">Entrada:</label>
                                    <div class="">

                                        <input type="time" class="form-control text-contenedor " id="entradaJueves" name="entradaJueves" value="{{ old('entradaJueves', $horario->entrada_jueves?? '') }}" disabled>
                                    
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="espacio" class="form-label titulos margenes-contenedor">Salida:</label>
                                    <div class="">
                                        <input type="time" class="form-control text-contenedor " id="salidaJueves" name="salidaJueves" value="{{ old('salidaJueves', $horario->salida_jueves?? '') }}" disabled>
                                    </div>
                                </div>

                                <label for="espacio" class="form-label titulos">Viernes:</label>
                                <div class="col-6">
                                    <label for="espacio" class="form-label titulos margenes-contenedor">Entrada:</label>
                                    <div class="">

                                        <input type="time" class="form-control text-contenedor " id="entradaViernes" name="entradaViernes" value="{{ old('entradaViernes', $horario->entrada_viernes?? '') }}" disabled>
                                    
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="espacio" class="form-label titulos margenes-contenedor">Salida:</label>
                                    <div class="">
                                        <input type="time" class="form-control text-contenedor " id="salidaViernes" name="salidaViernes" value="{{ old('salidaViernes', $horario->salida_viernes?? '') }}" disabled>
                                    </div>
                                </div>

                                <label for="espacio" class="form-label titulos">Sabado:</label>
                                <div class="col-6">
                                    <label for="espacio" class="form-label titulos margenes-contenedor">Entrada:</label>
                                    <div class="">

                                        <input type="time" class="form-control text-contenedor " id="entradaSabado" name="entradaSabado" value="{{ old('entradaSabado', $horario->entrada_sabado?? '') }}" disabled>
                                    
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="espacio" class="form-label titulos margenes-contenedor">Salida:</label>
                                    <div class="">
                                        <input type="time" class="form-control text-contenedor " id="salidaSabado" name="salidaSabado" value="{{ old('salidaSabado', $horario->salida_sabado?? '') }}" disabled>
                                    </div>
                                </div>

                            </div>
                        </div>
                    

                        <div class="d-flex justify-content-end gap-2 btn-contenedor">
                            <button type="button" class="btn-editar" id="editarMaestro">Editar</button>
                            <button type="submit" class="btn-custom" id="guardarMaestro" style="display: none;">Guardar</button>
                            <button type="button" class="btn-cancelar" id="cancelarMaestro" style="display: none;">Cancelar</button>
                        </div>



                    </div>

                </form>

            </div>

        </div>
    </div>

    
</div> 


@endsection