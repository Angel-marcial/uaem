<!--
    Codice
    Nombre del Código: alumnos.blade.php
    Fecha de Creación: 09/10/2024
    Revisado por: Jose Angel Monsalvo Cruz

    Modificaciones:

    Descripción: Este archivo PHP contiene la tabla de los alumnos
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


        <form action="{{ url('admin-buscar-alumnos') }}" method="GET">

            <div class="input-group mb-3 form-min-size alto">
                <input type="text" class="form-control" name="search" placeholder="Numero de cuenta..." value="{{ request('search') }}">
                <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                <button class="btn btn-success" type="submit">Nuevo</button>
            </div>
        </form>

        <table class="table">
            <thead class="table-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">No Cuenta</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Carrera</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @php $i = ($alumnos->currentPage() - 1) * $alumnos->perPage() + 1; @endphp
                @foreach ($alumnos as $alumno)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $alumno->no_cuenta }}</td>
                        <td>{{ $alumno->nombre }} {{ $alumno->apellido_paterno }} {{ $alumno->apellido_materno }}</td>
                        <td>{{ $alumno->telefono }}</td>
                        <td>{{ $alumno->carrera }}</td>
                        <td><a href="{{ url('admin-ver-alumnos/'.$alumno->no_cuenta) }}" class="btn btn-warning">Editar</a></td>
                        <td><a href="{{ url('admin-elimina-alumnos/'.$alumno->no_cuenta) }}" class="btn btn-danger" >Eliminar</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Paginación -->
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                {{ $alumnos->links('pagination::bootstrap-4') }}
            </ul>
        </nav>

    </div> <!-- Cierre del div correctamente -->

@endsection
