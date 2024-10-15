<!--
    Codice
    Nombre del Código: maestros.blade.php
    Fecha de Creación: 14/10/2024
    Revisado por: Jose Angel Monsalvo Cruz

    Modificaciones:

    Descripción: Este archivo PHP contiene la tabla de los maestros
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

        <h1>Maestros</h1>

        <form action="{{ url('admin-buscar-maestros') }}" method="GET">
            <div class="input-group mb-3 form-min-size alto">
                <input type="text" class="form-control" name="search" placeholder="Numero de cuenta..." value="{{ request('search') }}">
                <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                <a class="btn btn-success" href="{{ url('admin-nuevo-alumno') }}">Nuevo</a>
            </div>
        </form>

        <table class="table">
            <thead class="table-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">No Cuenta</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Estatus</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @php $i = ($maestros->currentPage() - 1) * $maestros->perPage() + 1; @endphp
                @foreach ($maestros as $maestro)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $maestro->no_cuenta }}</td>
                        <td>{{ $maestro->nombre }} {{ $maestro->apellido_paterno }} {{ $maestro->apellido_materno }}</td>
                        <td>{{ $maestro->telefono }}</td>
                        <td>{{ $maestro->correo }}</td>
                        <td>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheck{{ $maestro->id }}" 
                                {{ $maestro->estatus ? 'checked' : '' }} onchange="toggleEstatus(this, {{ $maestro->id }})">
                            </div>
                            
                        </td>
                        <td><a href="{{ url('admin-ver-alumnos/'.$maestro->no_cuenta) }}" class="btn btn-warning">Editar</a></td>
                        <td><a href="{{ url('admin-elimina-maestro/'.$maestro->no_cuenta) }}" class="btn btn-danger" >Eliminar</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Paginación -->
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                {{ $maestros->links('pagination::bootstrap-4') }}
            </ul>
        </nav>

    </div>

@endsection