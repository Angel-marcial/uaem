<!--
    Codice
    Nombre del Código: maestros.blade.php
    Fecha de Creación: 21/10/2024
    Revisado por: Angel Geovanni Marcial Morales

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

        <h1>Guardias</h1>

        <form action="{{ url('admin-buscar-guardias') }}" method="GET">
            <div class="input-group mb-3 form-min-size alto">
                <input type="text" class="form-control" name="search" placeholder="Numero de cuenta..." value="{{ request('search') }}">
                <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                <a class="btn btn-success" href="{{ url('admin-nuevo-guardia') }}">Nuevo</a>
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
                @php $i = ($guardias->currentPage() - 1) * $guardias->perPage() + 1; @endphp
                @foreach ($guardias as $guardia)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $guardia->no_cuenta }}</td>
                        <td>{{ $guardia->nombre }} {{ $guardia->apellido_paterno }} {{ $guardia->apellido_materno }}</td>
                        <td>{{ $guardia->telefono }}</td>
                        <td>{{ $guardia->correo }}</td>
                        <td>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheck{{ $guardia->id }}" 
                                {{ $guardia->estatus ? 'checked' : '' }} onchange="toggleEstatus(this, {{ $guardia->id }})">
                            </div>
                            
                        </td>
                        <td><a href="{{ url('admin-ver-guardia/'.$guardia->no_cuenta) }}" class="btn btn-warning">Editar</a></td>
                        <td><a href="{{ url('admin-elimina-guardia/'.$guardia->no_cuenta) }}" class="btn btn-danger" >Eliminar</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Paginación -->
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                {{ $guardias->links('pagination::bootstrap-4') }}
            </ul>
        </nav>

    </div>

    <script>
        function toggleEstatus(checkbox, guardiaId) 
        {
            const nuevoEstatus = checkbox.checked ? 1 : 0;
        
            fetch(`/actualizar-estatus-alumno/${guardiaId}`, 
            {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    estatus: nuevoEstatus
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) 
                {
                    console.log('Estatus actualizado con éxito');
                    
                } else 
                {
                    checkbox.checked = !nuevoEstatus;
                    alert('Hubo un error al actualizar el estatus.');
                }
            })
            .catch(error => 
            {
                console.error('Error al actualizar el estatus:', error);
                checkbox.checked = !nuevoEstatus;
                alert('Error al conectar con el servidor.');
            });
        }
    </script>


@endsection