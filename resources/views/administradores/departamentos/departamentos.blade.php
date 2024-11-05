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

        <form action="{{ url('admin-buscar-coordinador') }}" method="GET">
            <div class="input-group mb-3 form-min-size alto">
                <input type="text" class="form-control" name="search" placeholder="Numero de cuenta..." value="{{ request('search') }}">
                <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                <a class="btn btn-success" href="{{ url('admin-nuevo-coordinador') }}">Nuevo</a>
            </div>
        </form>

        <table class="table">
            <thead class="table-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">No Cuenta</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Departamento</th>
                    <th scope="col">Edificio</th>
                    <th scope="col">Aula</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Estatus</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @php $i = ($coordinadores->currentPage() - 1) * $coordinadores->perPage() + 1; @endphp
                @foreach ($coordinadores as $coordinador)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $coordinador->no_cuenta }}</td>
                        <td>{{ $coordinador->nombre }} {{ $coordinador->apellido_paterno }} {{ $coordinador->apellido_materno }}</td>
                        <td>{{ $coordinador->nombre_departamento }}</td>
                        <td>{{ $coordinador->edificio }}</td>
                        <td>{{ $coordinador->aula }}</td>
                        <td>{{ $coordinador->correo }}</td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheck{{ $coordinador->id_usuario }}" 
                                {{ $coordinador->estatus ? 'checked' : '' }} onchange="toggleEstatus(this, {{ $coordinador->id_usuario }})">
                            </div>
                            
                        </td>
                        <td><a href="{{ url('admin-ver-departamento/'.$coordinador->id_departamento) }}" class="btn btn-warning">Editar</a></td>

                        @if($coordinador->id_departamento == 1)
                            <td><a href="{{ url('admin-elimina-departamento/' . $coordinador->id_usuario) }}" class="btn btn-danger disabled" aria-disabled="true">Eliminar</a></td>
                        @else
                            <td><a href="{{ url('admin-elimina-departamento/'.$coordinador->id_usuario) }}" class="btn btn-danger" >Eliminar</a></td>
                        @endif

                        
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Paginación -->
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                {{ $coordinadores->links('pagination::bootstrap-4') }}
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


