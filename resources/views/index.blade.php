<!-- 
    Codice
    Nombre del Código: FormularioRegistro.html
    Fecha de Creación: 2024-09-10
    Revisado por: Juan Pérez

    Modificaciones:
    - 2024-09-12, Ajuste en el diseño del formulario, Folio: Formato de solicitud de cambios, ajustes y/o creación de nuevo software - V1.0
    - 2024-09-15, Inclusión de validaciones del lado del cliente, Folio: Formato de solicitud de cambios, ajustes y/o creación de nuevo software - V1.0

    Descripción: Este archivo HTML contiene el formulario para el registro de usuarios. 
    Incluye campos para nombre, email y contraseña, y está diseñado para ser responsive.
-->


<!--
    Codice
    Nombre del Código: index.blade.php
    Fecha de Creación: 22/08/2024 revisado por Jose Angel Monsalvo Cruz

    Modificaciones:

    Descripción: Este archivo PHP contiene el formulario para el inicio de sesion de los usuarios de la interfaz usuarios. 
    Incluye campos para email y contraseña para validar los ingresos.
-->
@extends('usuarios.app')

@section('content')

<div class="margenes-contenedor">

    @if (session('status'))

        <div class="alert alert-success">
            {{ session('status') }}
        </div>

    @endif

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6"> <!-- Columna para la imagen -->
                <img src="{{ asset('uapt.jpg') }}" alt="uapt" class="img-fluid" style="height: 400px;">
            </div>
            <div class="col-md-6 contenedor"> <!-- Columna para el formulario -->
                <h3 class="mb-4 titulos">Unidad Académica Profesional Tianguistenco </h3>
                <h4 class="mb-4 titulos">iniciar sesíon</h4>

                <form >
                    @csrf
                    <div class="mb-3">
                        <label for="correo" class="form-label titulos ">Correo:</label>
                        <input type="email" class="form-control text-contenedor" id="correo" name="correo" placeholder="Ej: alumno@(alumno 'O' profesor).uaemex.mx" required>
                    </div>
                    <div class="mb-3">
                        <label for="contra" class="form-label titulos">Contraseña:</label>
                        <input type="password" class="form-control text-contenedor" id="contra" name="contra" placeholder="*********" required>
                    </div>
                    <div class="btn-contenedor">
                        <button type="submit" class="btn-custom ">Iniciar sesion</button>
                    </div>
                    <div class="btn-contenedor">
                        <a href="http://web.uaemex.mx/avisos/Aviso_Privacidad.pdf" class="btn-link">Aviso de privacidad </a>
                    </div> 
                </form>
            </div>
        </div>
    </div>

    <div style="margin-top: 50px;">





        








    </div>

@endsection

<!--
<form action="" method="POST">
    @csrf
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre:</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required>
    </div>
    <div class="mb-3">
        <label for="edad" class="form-label">Edad:</label>
        <input type="number" class="form-control" id="edad" name="edad" required>
    </div>
    <div class="mb-3">
        <label for="correo" class="form-label">Correo:</label>
        <input type="email" class="form-control" id="correo" name="correo" required>
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>
-->

<!--
<div class="container mt-5">
    <h1 class="mb-4">Crear Usuario</h1>

    <form action="" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>

        <div class="mb-3">
            <label for="edad" class="form-label">Edad:</label>
            <input type="number" class="form-control" id="edad" name="edad" required>
        </div>

        <div class="mb-3">
            <label for="correo" class="form-label">Correo:</label>
            <input type="email" class="form-control" id="correo" name="correo" required>
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>
-->