<!--
    Codice
    Nombre del Código: indexAlumnos.blade.php
    Fecha de Creación: 22/08/2024 revisado por Angel Geovanni Marcial Morales

    Modificaciones:

    Descripción: Este archivo PHP contiene el formulario para el alta de nuevos alumnos. 
    Cuenta con campos para validar si el alumno cuenta con un correo valido. 
    cuenta con validacion de correo y continua con el registro de los alumnos
-->
@extends('alumnos.contenido')

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

            <div class="alert alert-danger" id="errorDiv" style="display:none;">
                <!--<button type="submit" class="btn-custom " id="cancelar">X</button>-->
            </div>

        @endif

        <div class="btn-contenedor">   
            <div class="col-md-5">
                <h5 class="{{ (session('correoEnviado') || session('codigoAprobado')) ? 'hidden' : ''}} ">Verificar Correo</h5>
                <div class="{{ (session('correoEnviado') || session('codigoAprobado')) ? 'hidden' : '' }} contenedor margenes-contenedor">
                    
                    <form action="{{ url('enviar-correo-alumnos') }}" method="POST" onsubmit="return deshabilitarBotonCorreo(this)">
                        @csrf

                        <div class="row g-0 btn-contenedor margenes-contenedor">

                            <input type="hidden" name="redirectRoute" value="{{ url('index-alumnos') }}">
                            <div class="margenes-contenedor mb-3">
                                <label for="correo" class="form-label titulos margenes-contenedor">Correo:</label>
                                <input type="email" class="form-control text-contenedor" id="correo" name="correo" placeholder="Ej: alumno@alumno.uaemex.mx" required>
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
                        <input type="hidden" name="redirectRoute" value="{{ url('index-alumnos') }}">
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
            <div class="col-md-5">   

                <h5 class="{{ session('codigoAprobado') ? '' : 'hidden' }}">Datos del alumno</h5>
                <div class="{{ session('codigoAprobado') ? '' : 'hidden' }} contenedor margenes-contenedor">
                    
                    <form action="{{ url('guardar-alumnos') }}" method="POST" onsubmit="return alumno(this)">
                        @csrf
                        
                            <div class="margenes-contenedor">


                            <div class="row g-0">
                                <div class="col-sm-6 col-md-8">

                                    <label for="carreras" class="form-label titulos margenes-contenedor">Selecciona una carrera:</label>
                                    <select class="form-control text-contenedor btn-contenedor"  id="carreras" name="carreras">
                                        <option value="ingenieria-software">Ingeniería de Software</option>
                                        <option value="ingenieria-industrial">Producción Industrial</option>
                                        <option value="ingenieria-plasticos">Ingeniería de Plasticos</option>
                                        <option value="ingenieria-sistemas">Ingeniería de Sistemas</option>
                                        <option value="ingenieria-mecanica">Ingeniería Mecanica</option>
                                        <option value="seguridad-ciudadana">Seguridad Ciudadana</option>
                                    </select>
                                    
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