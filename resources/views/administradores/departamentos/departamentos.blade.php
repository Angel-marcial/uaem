<!--
    Codice
    Nombre del Código: departamentos.blade.php
    Fecha de Creación: 22/10/2024
    Revisado por: Angel Geovanni Marcial Morales

    Modificaciones:

    Descripción: Este archivo PHP contiene la tabla de los cordinadores
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

        <h1>Departamentos</h1>

        <form action="{{ url('admin-buscar-alumnos') }}" method="GET">
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
                    <th scope="col">Teléfono</th>
                    <th scope="col">Carrera</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Estatus</th>
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
                        <td>{{ $alumno->correo }}</td>
                        <td>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheck{{ $alumno->id }}" 
                                {{ $alumno->estatus ? 'checked' : '' }} onchange="toggleEstatus(this, {{ $alumno->id }})">
                            </div>
                            
                        </td>
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

    </div>

    <script>
        function toggleEstatus(checkbox, alumnoId) 
        {
            const nuevoEstatus = checkbox.checked ? 1 : 0;
        
            fetch(`/actualizar-estatus-alumno/${alumnoId}`, 
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


