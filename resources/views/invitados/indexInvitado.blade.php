<!--
    Codice
    Nombre del Código: indexInvitado.blade.php
    Fecha de Creación: 10/09/2024 revisado por Angel Geovanni Marcial Morales

    Modificaciones:

    Descripción: Este archivo PHP contiene el formulario de nuevos invitado en la interfaz invitados. 
-->
@extends('invitados.contenido')

@section('content')

<div class="margenes-contenedor">

    <div class="btn-contenedor">   
        <div class="col-md-5">
            <h5 class="">Datos</h5>
            <div class="contenedor margenes-contenedor">
                
                <form action="" method="POST" onsubmit="return deshabilitarBotonCorreo(this)">
                    @csrf

                    <div class="row g-0 btn-contenedor margenes-contenedor">

                        <input type="hidden" name="redirectRoute" value="{{ url('index-invitado') }}">

                        <div>
                            <label for="nombres" class="form-label titulos margenes-contenedor">Nombre completo</label>
                            <input type="text" class="form-control text-contenedor " id="nombres" name="nombres" placeholder="Angel Geovanni Garcia Garcia" required>
                        </div>

                        <div>
                            <label for="correo" class="form-label titulos margenes-contenedor">Correo:</label>
                            <input type="email" class="form-control text-contenedor" id="correo" name="correo" placeholder="Ej: usuario@gmail.com" required>
                        </div>

                        <div>
                            <label for="telefono" class="form-label titulos margenes-contenedor">Telefono</label>
                            <input type="number" class="form-control text-contenedor " id="telefono" name="telefono" placeholder="7200000000" required>
                        </div>

                        <div class="row g-0">
                            <div class="col-sm-6 col-md-8">

                                <label for="area" class="form-label titulos margenes-contenedor">Selecciona el Area a visitar:</label>
                                <select class="form-control text-contenedor btn-contenedor"  id="areas" name="areas">
                                    <option value="control-escolar">Control Escolar</option>
                                    <option value="biblioteca">Biblioteca</option>
                                    <option value="auto-acceso">Auto Acceso</option>
                                    <option value="servicio-social">Servicio Social</option>
                                    <option value="cafeteria">Cafeteria</option>
                                </select>
                        
                            </div>

                            <div class="col-6 col-md-4">
                        
                                <label for="dia" class="form-label titulos margenes-contenedor">Hora de la visita:</label>
                                <input type="Text" class="form-control text-contenedor " id="telefono" name="telefono" placeholder="10:00" required>
                            
                        
                            </div>
                        </div>

                        <div>
                            <label for="fecha" class="form-label titulos margenes-contenedor">Fecha de la visita</label>
                            <input type="date" class="form-control text-contenedor" id="fecha" name="fecha" required>
                        </div>

                        <div>
                            <label for="motivo" class="form-label titulos margenes-contenedor">Motivo de la visita</label>
                            <textarea class="form-control text-contenedor" id="motivo" name="motivo" placeholder="Escriba el motivo de su visita" rows="3" required></textarea>
                        </div>

                    
                        <div class="btn-contenedor">
                            <button type="submit" class="btn-custom " id="verificar">Verificar</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>






</div>

@endsection