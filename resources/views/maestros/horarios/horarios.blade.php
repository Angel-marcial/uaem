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
            <h1>REGISTRO DE ENTRADAS Y SALIDAS</h1>

            <!-- Formulario de Búsqueda -->
            <form action="{{ route('maestros.horarios.horarios') }}" method="GET">
                <div class="input-group mb-3 form-min-size alto">
                    <select name="option" id="searchOption" class="form-control" onchange="toggleSearchFields()">
                        <option value="" {{ $option == '' ? 'selected' : '' }}>--SELECCIONA UNA OPCIÓN--</option>
                        <option value="1" {{ $option == '1' ? 'selected' : '' }}>Día Específico</option>
                        <option value="2" {{ $option == '2' ? 'selected' : '' }}>Rango de Fechas</option>
                    </select>
        
                    <!-- Campo para un solo día como selector de fecha -->
                    <input type="date" class="form-control {{ $option == '1' ? '' : 'd-none' }}" id="dayInput" name="day" value="{{ $day }}" placeholder="Fecha específica">
                    
                    <!-- Campos para rango de fechas -->
                    <input type="date" class="form-control {{ $option == '2' ? '' : 'd-none' }}" id="startDateInput" name="start_date" value="{{ $startDate }}" placeholder="Fecha de inicio">
                    <input type="date" class="form-control {{ $option == '2' ? '' : 'd-none' }}" id="endDateInput" name="end_date" value="{{ $endDate }}" placeholder="Fecha de fin">
        
                    <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                </div>
            </form>
        
            <!-- Tabla de Resultados -->
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Numero de Cuenta</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Hora de Entrada</th>
                        <th scope="col">Hora de Salida</th>
                        <th scope="col">Dia</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($query_principal as $row)
                        <tr>
                            <td>{{ $row->no_cuenta }}</td>
                            <td>{{ $row->nombre }}</td>
                            <td>{{ $row->telefono }}</td>
                            <td>{{ $row->fecha }}</td>
                            <td>{{ $row->{"Hora de entrada"} }}</td>
                            <td>{{ $row->{"Hora de salida"} }}</td>
                            <td>{{ $row->dia }}</td>
                        </tr>
                     @endforeach
                </tbody>
            </table>
        
            <!-- Información de la página actual y total de páginas -->
           <!-- Información de la página actual y total de páginas -->
           <div class="d-flex justify-content-between align-items-center">
                <div>
                    Página {{ $query_principal->currentPage() }} de {{ $query_principal->lastPage() }}
                </div>
                
                <!-- Enlaces de paginación -->
                <div>
                    {{ $query_principal->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div> 

            <br><br>
            <a href="{{ route('export.ingreso_salida', request()->all()) }}" class="btn btn-success">Descargar en Excel</a>
        
            <script>
                function toggleSearchFields() 
                {
                    var option = document.getElementById("searchOption").value;
                    var dayInput = document.getElementById("dayInput");
                    var startDateInput = document.getElementById("startDateInput");
                    var endDateInput = document.getElementById("endDateInput");
        
                    // Restablecer la visibilidad de todos los campos
                    dayInput.classList.add("d-none");
                    startDateInput.classList.add("d-none");
                    endDateInput.classList.add("d-none");
        
                    // Mostrar el campo adecuado según la opción seleccionada
                    if (option === "1") {
                        dayInput.classList.remove("d-none");  // Mostrar solo el campo de fecha específica
                    } else if (option === "2") {
                        startDateInput.classList.remove("d-none");  // Mostrar los campos de rango de fechas
                        endDateInput.classList.remove("d-none");
                    }
                }
            </script>
    
    


@endsection
