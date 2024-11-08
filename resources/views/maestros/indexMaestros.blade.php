<!--
    Codice
    Nombre del Código: indexMaestros.blade.php
    Fecha de Creación: 07/09/2024 revisado por Angel Geovanni Marcial Morales

    Modificaciones:

    Descripción: Este archivo PHP contiene el formulario de nuevos maestros en la interfaz maestros . 
    Incluye campos para email y contraseña para validar los ingresos.
-->
@extends('maestros.contenido')


@section('content')

<div class="margenes-contenedor">

    @if (session('status') || session('status2'))

        @if (session('correoEnviado') || session('codigoAprobado') && session('error') == false)
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        

        @elseif(session('error'))
        
            <div id="divCerrar1" class="alert alert-danger">
                {{ session('status') }}

                <button type="button" class="cerrar"  id="cerrar1" onclick="cerrarMensaje()">X</button>
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
        <div class="col-md-5">
            <h5 class="{{ (session('correoEnviado') || session('codigoAprobado')) ? 'hidden' : ''}} ">Verificar Correo</h5>
            <div class="{{ (session('correoEnviado') || session('codigoAprobado')) ? 'hidden' : '' }} contenedor margenes-contenedor">
                
                <form action="{{ url('enviar-correo-maestros') }}" method="POST" onsubmit="return ValidarCorro(this)">
                    @csrf
                    <div class="row g-0 btn-contenedor margenes-contenedor">   
                        <input type="hidden" name="redirectRoute" value="{{ url('index-maestros') }}">
                        <div class="margenes-contenedor mb-3">
                            <label for="correo" class="form-label titulos margenes-contenedor">Correo:</label>
                            <input type="email" class="form-control text-contenedor" id="correo" name="correo" placeholder="Ej: profesor@profesor.uaemex.mx" required>
                        </div>
                        <div class="btn-contenedor">
                            <button type="submit" class="btn-custom " id="verificar">Verificar</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>    

    <div class="btn-contenedor">   
        <div class="col-md-5">   
            <h5 class="{{ session('correoEnviado') ? '' : 'hidden' }}">Validar Correo</h5>
            <div class="{{ session('correoEnviado') ? '' : 'hidden' }} contenedor margenes-contenedor">
                <form action="{{ url('codigo-seguridad') }}" method="POST" onsubmit="return deshabilitarBotonCodigo(this)">
                    <label class="form-label titulos margenes-contenedor">Codigo de seguridad</label>
                    @csrf
                    <input type="hidden" name="redirectRoute" value="{{ url('index-maestros') }}">
                    <div class="input-group btn-contenedor">
                        <div>
                            <input type="number" class="form-control text-contenedor input-item" id="numero1" name="numero1" placeholder="0" required maxlength="1" oninput="validarDigito(this)">
                        </div>
                        <div >
                            <input type="number" class="form-control text-contenedor input-item" id="numero2" name="numero2" placeholder="0" required maxlength="1" oninput="validarDigito(this)">
                        </div>
                        <div>
                            <input type="number" class="form-control text-contenedor input-item" id="numero3" name="numero3" placeholder="0" required maxlength="1" oninput="validarDigito(this)">
                        </div>
                        <div>
                            <input type="number" class="form-control text-contenedor input-item" id="numero4" name="numero4" placeholder="0" required maxlength="1" oninput="validarDigito(this)">
                        </div>
                        <div>
                            <input type="number" class="form-control text-contenedor input-item" id="numero5" name="numero5" placeholder="0" required maxlength="1" oninput="validarDigito(this)"> 
                        </div>
                        <div>
                            <input type="number" class="form-control text-contenedor input-item" id="numero6" name="numero6" placeholder="0" required maxlength="1" oninput="validarDigito(this)">
                        </div>
                        <div >
                            <input type="number" class="form-control text-contenedor input-item" id="numero7" name="numero7" placeholder="0" required maxlength="1" oninput="validarDigito(this)">
                        </div>
                    </div>
                    <div class="btn-contenedor">
                        <button type="submit" class="btn-custom" id="validar">Validar</button>
                    </div>
                
                </form>
            </div>
        </div>
    </div>

    <div class="btn-contenedor">   
        <div class="col-md-7">   

            <h5 class="{{ session('codigoAprobado') ? '' : 'hidden' }}">Datos del Profesor</h5>

            <div class="{{ session('codigoAprobado') ? '' : 'hidden' }} contenedor margenes-contenedor">
            
                <form action="{{ url('guardar-maestros') }}" method="POST" onsubmit="return maestro(this)">
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
                        
                        <h5>Horario</h5>
                    
                        <div class="container text-center">
                            <div class="row g-2">

                                <label for="espacio" class="form-label titulos">Lunes:</label>
                                <div class="col-6">
                                    <label for="espacio" class="form-label titulos margenes-contenedor">Entrada:</label>
                                    <div class="">
                                        
                                        <input type="time" class="form-control text-contenedor" id="entradaLunes" name="entradaLunes" value="{{ old('entradaLunes') }}">

                                    </div>

                                </div>
                                <div class="col-6">
                                    <label for="espacio" class="form-label titulos margenes-contenedor">salida:</label>
                                    <div class="">

                                        <input type="time" class="form-control text-contenedor" id="salidaLunes" name="salidaLunes" value="{{ old('salidaLunes') }}">

                                    </div>
                                </div>
                                
                                <label for="espacio" class="form-label titulos">Martes:</label>
                                <div class="col-6">
                                    <label for="espacio" class="form-label titulos margenes-contenedor">Entrada:</label>
                                    <div class="">

                                        <input type="time" class="form-control text-contenedor" id="entradaMartes" name="entradaMartes" value="{{ old('entradaMartes') }}">
                                    
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="espacio" class="form-label titulos margenes-contenedor">Salida:</label>
                                    <div class="">
                                        <input type="time" class="form-control text-contenedor" id="salidaMartes" name="salidaMartes" value="{{ old('salidaMartes') }}">
                                    </div>
                                </div>
                                
                                <label for="espacio" class="form-label titulos">Miercoles:</label>
                                <div class="col-6">
                                    <label for="espacio" class="form-label titulos margenes-contenedor">Entrada:</label>
                                    <div class="">

                                        <input type="time" class="form-control text-contenedor" id="entradaMiercoles" name="entradaMiercoles" value="{{ old('entradaMiercoles') }}">
                                    
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="espacio" class="form-label titulos margenes-contenedor">Salida:</label>
                                    <div class="">
                                        <input type="time" class="form-control text-contenedor" id="salidaMiercoles" name="salidaMiercoles" value="{{ old('salidaMiercoles') }}">
                                    </div>
                                </div>

                                <label for="espacio" class="form-label titulos">Jueves:</label>
                                <div class="col-6">
                                    <label for="espacio" class="form-label titulos margenes-contenedor">Entrada:</label>
                                    <div class="">

                                        <input type="time" class="form-control text-contenedor " id="entradaJueves" name="entradaJueves" value="{{ old('entradaJueves') }}">
                                    
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="espacio" class="form-label titulos margenes-contenedor">Salida:</label>
                                    <div class="">
                                        <input type="time" class="form-control text-contenedor " id="salidaJueves" name="salidaJueves" value="{{ old('salidaJueves') }}">
                                    </div>
                                </div>

                                <label for="espacio" class="form-label titulos">Viernes:</label>
                                <div class="col-6">
                                    <label for="espacio" class="form-label titulos margenes-contenedor">Entrada:</label>
                                    <div class="">

                                        <input type="time" class="form-control text-contenedor " id="entradaViernes" name="entradaViernes" value="{{ old('entradaViernes') }}">
                                    
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="espacio" class="form-label titulos margenes-contenedor">Salida:</label>
                                    <div class="">
                                        <input type="time" class="form-control text-contenedor " id="salidaViernes" name="salidaViernes" value="{{ old('salidaViernes') }}">
                                    </div>
                                </div>

                                <label for="espacio" class="form-label titulos">Sabado:</label>
                                <div class="col-6">
                                    <label for="espacio" class="form-label titulos margenes-contenedor">Entrada:</label>
                                    <div class="">

                                        <input type="time" class="form-control text-contenedor " id="entradaSabado" name="entradaSabado" value="{{ old('entradaSabado') }}">
                                    
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="espacio" class="form-label titulos margenes-contenedor">Salida:</label>
                                    <div class="">
                                        <input type="time" class="form-control text-contenedor " id="salidaSabado" name="salidaSabado" value="{{ old('salidaSabado') }}">
                                    </div>
                                </div>

                            </div>
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