<!--
    @author Vladimir Lemus
    Codice
    Nombre del Código: contenido.blade.php
    Fecha de Creación: 01/11/2024 revisado por Angel Geovanni Marcial Morales

    Modificaciones:

    Descripción: Este archivo PHP contiene las dependencias, fuentes y links que usuara la interfaz maestros
-->

@extends('maestros.contenido')
@section('content')

@if (session('status'))
    @if (!session('error'))
        <div id="divCerrar1" class="alert alert-danger">
            {{ session('status') }}
            <button type="button" class="cerrar" id="cerrar1" onclick="cerrarMensaje()">X</button>
        </div>
    @else
        <div id="divCerrar2" class="alert alert-success">
            {{ session('status') }}
            <button type="button" class="cerrar" id="cerrar2" onclick="cerrarMensaje2()">X</button>
        </div>
    @endif
@endif

<div class="btn-contenedor">   
    <div class="col-md-7">
        <h5>MIS HORARIOS</h5>

        <div class="contenedor margenes-contenedor">
            <form action="{{ route('editar-horario', ['id' => $cordinador->id]) }}" method="POST">
                @csrf
                <div class="margenes-contenedor">
                    <!-- Tabla de horarios -->
                    <div class="mt-4">
                        <h5>Horario</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Día</th>
                                    <th>Entrada</th>
                                    <th>Salida</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sabado'];
                                    $entradas = [
                                        $maestro->entrada_lunes ?? '', 
                                        $maestro->entrada_martes ?? '', 
                                        $maestro->entrada_miercoles ?? '', 
                                        $maestro->entrada_jueves ?? '', 
                                        $maestro->entrada_viernes ?? '',
                                        $maestro->entrada_sabado ?? '' // Campo para el sábado
                                    ];
                                    $salidas = [
                                        $maestro->salida_lunes ?? '', 
                                        $maestro->salida_martes ?? '', 
                                        $maestro->salida_miercoles ?? '', 
                                        $maestro->salida_jueves ?? '', 
                                        $maestro->salida_viernes ?? '',
                                        $maestro->salida_sabado ?? '' // Campo para el sábado
                                    ];
                                @endphp
                                @foreach($dias as $index => $dia)
                                    <tr>
                                        <td>{{ $dia }}</td>
                                        <td>
                                            <input type="text" class="form-control entrada" id="entrada_{{ strtolower($dia) }}" 
                                                   name="entrada_{{ strtolower($dia) }}" 
                                                   value="{{ old('entrada_'.strtolower($dia), $entradas[$index]) }}" 
                                                   pattern="\d{2}:\d{2}:\d{2}" placeholder="HH:MM:SS">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control salida" id="salida_{{ strtolower($dia) }}" 
                                                   name="salida_{{ strtolower($dia) }}" 
                                                   value="{{ old('salida_'.strtolower($dia), $salidas[$index]) }}" 
                                                   pattern="\d{2}:\d{2}:\d{2}" placeholder="HH:MM:SS">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            
                    <!-- Botones de acción -->
                    <div class="mt-3 d-flex">
                        <button type="button" class="btn btn-warning me-2" onclick="habilitarEdicion()">Editar</button>
                        <button type="submit" class="btn btn-success" id="guardarBtn" style="display: none;">Guardar Cambios</button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</div>

<script>
    // Función para habilitar los campos de edición de horarios
    function habilitarEdicion() {
        console.log("Función habilitarEdicion ejecutada");

        // Habilita todos los inputs de entrada y salida
        document.querySelectorAll('.entrada, .salida').forEach(input => {
            input.disabled = false;
        });

        // Muestra el botón de "Guardar Cambios"
        document.getElementById('guardarBtn').style.display = 'block';
    }
</script>

@endsection
