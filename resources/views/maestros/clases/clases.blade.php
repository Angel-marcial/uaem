<!--
@author Vladimir Lemus
    Codice
    Nombre del Código: contenido.blade.php
    Fecha de Creación: 09/11/2024 revisado por Angel Geovanni Marcial Morales

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
            <form action="{{ url('editar-horario')}}" method="POST">
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
                                    @php
                                        // Normalizamos el nombre del día quitando caracteres especiales
                                        $dia_normalizado = strtolower(str_replace(['á', 'é', 'í', 'ó', 'ú'], ['a', 'e', 'i', 'o', 'u'], $dia));
                                    @endphp
                                    <tr>
                                        <td>{{ $dia }}</td>
                                        <td>
                                            <input type="text" class="form-control entrada" id="entrada_{{ $dia_normalizado }}" 
                                                   name="entrada_{{ $dia_normalizado }}" 
                                                   value="{{ old('entrada_'.$dia_normalizado, $entradas[$index]) }}" 
                                                   pattern="\d{2}:\d{2}:\d{2}" placeholder="HH:MM:SS">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control salida" id="salida_{{ $dia_normalizado }}" 
                                                   name="salida_{{ $dia_normalizado }}" 
                                                   value="{{ old('salida_'.$dia_normalizado, $salidas[$index]) }}" 
                                                   pattern="\d{2}:\d{2}:\d{2}" placeholder="HH:MM:SS">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            
                    <!-- Botones de acción -->
                    <div class="mt-3">
                        <!-- Botón para habilitar los campos de edición -->
                        <button type="button" class="btn btn-warning" id="editarBtn" onclick="habilitarEdicion()">Editar</button>
                        <!-- Botón para guardar los cambios -->
                        <button type="submit" class="btn btn-success" id="guardarBtn" style="display: none;">Guardar Cambios</button>
                        <!-- Botón para cancelar los cambios -->
                        <button type="button" class="btn btn-secondary" id="cancelarBtn" style="display: none;" onclick="cancelarEdicion()">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Variables para almacenar los valores originales
    let valoresOriginales = {};

    // Función para habilitar los campos de edición
    function habilitarEdicion() {
        // Guardar los valores originales
        document.querySelectorAll('.entrada, .salida').forEach(input => {
            valoresOriginales[input.id] = input.value; // Guardar valores originales
            input.disabled = false; // Habilitar campos
        });

        // Mostrar los botones "Guardar Cambios" y "Cancelar"
        document.getElementById('guardarBtn').style.display = 'inline-block';
        document.getElementById('cancelarBtn').style.display = 'inline-block';

        // Ocultar el botón "Editar"
        document.getElementById('editarBtn').style.display = 'none';
    }

    // Función para cancelar la edición y restaurar los valores originales
    function cancelarEdicion() {
        // Restaurar los valores originales en los campos
        document.querySelectorAll('.entrada, .salida').forEach(input => {
            input.value = valoresOriginales[input.id]; // Restaurar valores originales
            input.disabled = true; // Deshabilitar campos
        });

        // Ocultar los botones "Guardar Cambios" y "Cancelar"
        document.getElementById('guardarBtn').style.display = 'none';
        document.getElementById('cancelarBtn').style.display = 'none';

        // Mostrar el botón "Editar"
        document.getElementById('editarBtn').style.display = 'inline-block';
    }

    // Validar que solo se ingresen letras en los campos de texto
    function validarTexto(element) {
        const valor = element.value;
        const regex = /^[a-zA-ZÀ-ÿ\s]+$/;
        if (!regex.test(valor)) {
            element.value = valor.replace(/[^a-zA-ZÀ-ÿ\s]/g, "");
        }
    }

    // Formatear automáticamente los campos de hora (HH:MM:SS)
    function formatearHora(input) {
        let valor = input.value.replace(/[^0-9]/g, ''); // Eliminar caracteres no numéricos
        if (valor.length >= 3 && valor.length <= 4) {
            valor = valor.replace(/^(\d{2})(\d{1,2})/, '$1:$2');
        } else if (valor.length > 4) {
            valor = valor.replace(/^(\d{2})(\d{2})(\d{1,2})/, '$1:$2:$3');
        }
        input.value = valor.slice(0, 8); // Limitar el valor al formato HH:MM:SS
    }

    // Deshabilitar los campos de entrada al cargar la página y aplicar validación
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.entrada, .salida').forEach(input => {
            input.disabled = true; // Deshabilitar campos por defecto
            input.addEventListener('input', () => formatearHora(input)); // Validar formato HH:MM:SS
        });
    });
</script>

@endsection
