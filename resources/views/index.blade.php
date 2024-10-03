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
    Fecha de Creación: 22/08/2024
    Revisado por: Jose Angel Monsalvo Cruz

    Modificaciones:

    Descripción: Este archivo PHP contiene el formulario para el inicio de sesión de los usuarios de la interfaz usuarios. 
    Incluye campos para email y contraseña para validar los ingresos.
-->

@extends('usuarios.app')

@section('content')

<div class="margenes-contenedor">

    <div class="alert alert-danger" id="errorDiv" style="display:none;"></div>

    @if (session('status'))
        <script>
            document.addEventListener("DOMContentLoaded", function() 
            {
                var errorDiv = document.getElementById('errorDiv');
                errorDiv.textContent = "{{ session('status') }}"; // Mensaje de error
                errorDiv.style.display = "block"; // Muestra el div
            });
        </script>
    @endif

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6"> <!-- Columna para la imagen -->
                <img src="{{ asset('uapt.jpg') }}" alt="uapt" class="img-fluid" style="height: 400px;">
            </div>
            <div class="col-md-6 contenedor"> <!-- Columna para el formulario -->
                <h3 class="mb-4 titulos">Unidad Académica Profesional Tianguistenco</h3>
                <h4 class="mb-4 titulos">Iniciar Sesión</h4>

                <form id="formLogin" action="{{ url('login') }}" method="POST" onsubmit="return login(this)">
                    @csrf
                    <div class="mb-3">
                        <label for="correo" class="form-label titulos">Correo:</label>
                        <input type="email" class="form-control text-contenedor" id="correo" name="correo" placeholder="Ej: alumno@(alumno 'O' profesor).uaemex.mx" required>
                    </div>
                    <div class="mb-3">
                        <label for="contra" class="form-label titulos">Contraseña:</label>
                        <input type="password" class="form-control text-contenedor" id="contra" name="contra" maxlength="10" placeholder="*********" required>
                    </div>
                    <div class="btn-contenedor">
                        <button type="submit" class="btn-custom" id="verificar">Iniciar Sesión</button>
                    </div>
                    <div class="btn-contenedor">
                        <a href="http://web.uaemex.mx/avisos/Aviso_Privacidad.pdf" class="btn-link">Aviso de Privacidad</a>
                    </div> 
                </form>
            </div>
        </div>
    </div>

    <!-- Estilo para agregar la imagen de fondo sin alterar el diseño -->
    <style>
        .background-custom {
            background-image: url('http://ri.uaemex.mx/bitstream/handle/20.500.11799/111950/pleca%20inferior%20web.jpg?sequence=2&isAllowed=y');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin-top: 200px;
        }

        /* Estilo personalizado para hacer los textos blancos */
        .text-white {
            color: #fff;
        }

    </style>

    <div class="row background-custom" style="background-size: cover; background-position: center;">
        <div id="sp-bottom1" class="col-lg-3 ">
            <div class="sp-column">
                <div class="sp-module">
                    <div class="sp-module-content">
                        <div id="mod-custom114" class="mod-custom custom">
                            <center><img src="https://www.uaemex.mx/images/2024/Footer/sello.png" alt="Administración 2021-2025" style="display: block; margin-left: auto; margin-right: auto;" /></center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="sp-bottom2" class="col-sm-6 col-lg-3">
            <div class="sp-column">
                <div class="sp-module">
                    <div class="sp-module-content">
                        <div id="mod-custom115" class="mod-custom custom text-white"> <!-- Se agrega la clase text-white -->
                            <div class="wdgt-tl">Contacto</div>
                            <p>Universidad Autónoma del Estado de México.<br><i class="fas fa-map-marked-alt"></i>&nbsp;Instituto Literario # 100. C.P. 50000 Col. Centro<br><br>
                            <span style="font-size: 14pt;"><i class="fa fa-phone"></i><strong> 722 226 23 00 - Interior de la República</strong></span><br><i class="fa fa-phone"></i>&nbsp;011 52 722 226 23 00 - USA y Canadá<br><i class="fa fa-phone"></i>&nbsp;00 52 722 226 23 00 - Europa y resto del mundo<br><br>
                            <i class="fa fa-envelope"></i>&nbsp;<a href="mailto:rectoria@uaemex.mx" style="color: #fff;">rectoria@uaemex.mx</a></p>
                            <p><i class="fas fa-external-link-alt" aria-hidden="true"></i><a href="https://www.uaemex.mx/mi-universidad/directorio-telefónico.html" rel="noopener" style="color: #fff;"> Directorio Telefónico</a></p>
                            <p><a href="https://sa.uaemex.mx/dtic" target="_blank" rel="noopener"><img src="https://sa.uaemex.mx/dtic/images/logos/DTIC_md.png" alt="identidad-DTIC-2019_02.png" width="213" height="73"></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="sp-bottom3" class="col-lg-3">
            <div class="sp-column">
                <div class="sp-module">
                    <div class="sp-module-content">
                        <div id="mod-custom116" class="mod-custom custom text-white"> <!-- Se agrega la clase text-white -->
                            <div class="wdgt-tl">Vínculos de interés</div>
                            <p style="color: #fff;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i><a href="/avisos/Aviso_Privacidad.pdf" style="color: #fff;"> Aviso de Privacidad</a><br>
                            <i class="fas fa-external-link-alt" aria-hidden="true"></i><a href="http://transparencia.uaemex.mx/" target="_blank" rel="noopener" style="color: #fff;"> Transparencia</a><br>
                            <i class="fas fa-external-link-alt" aria-hidden="true"></i><a href="https://www.fundacionuaemex.org/" target="_blank" rel="noopener" style="color: #fff;"> Fundación UAEMéx</a><br><br>
                            <a href="https://vivas.uaemex.mx" target="_blank" rel="noopener" style="color: #fff;"><img src="https://www.uaemex.mx/images/2024/Footer/vivas-logo.png" alt="VIVAS" width="146" height="97"></a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sp-module">
                <div class="sp-module-content">
                    <div id="mod-custom117" class="mod-custom custom text-white"> <!-- Se agrega la clase text-white -->
                        <div class="wdgt-tl">Otros vínculos</div>
                        <p style="color: #fff;">
                            <i class="fas fa-external-link-alt" aria-hidden="true"></i>
                            <a href="http://www.testigossociales.org.mx/TestigosSociales/" target="_blank" rel="noopener" style="color: #fff;"> Testigos sociales </a><br>
                        </p>
                        <p>
                            <br />
                            <a href="http://web.uaemex.mx/contraloriasocial.html" target="_blank" rel="noopener" style="color: #fff;">
                                <img src="https://www.uaemex.mx/images/2024/Footer/contraloriasocial.png" alt="contraloría social" width="35%" />
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div id="sp-bottom4" class="col-lg-3 ">
            <div class="sp-column ">
                <div class="sp-module ">
                    <div class="sp-module-content">
                        <div id="mod-custom118" class="mod-custom custom text-white"> <!-- Se agrega la clase text-white -->
                            <div class="wdgt-tl">Medios y servicios</div>
                            <p>&nbsp;</p>
                            <p>
                                <a href="http://uniradio.uaemex.mx/" target="_blank" rel="noopener">
                                    <img src="https://www.uaemex.mx/images/2024/Footer/UniRadio.png" alt="UniRadio" width="130" />
                                </a>
                            </p>
                            <p>
                                <a href="https://hemeroteca.uaemex.mx/index.php/universitaria/" target="_blank" rel="noopener">
                                    <img src="https://www.uaemex.mx/images/2024/Footer/logo-universitaria.png" alt="logo universitaria" width="57" height="138" />
                                </a>
                            </p>
                            <p>
                                <a href="https://www.youtube.com/channel/UCe8Se89aeErlTzKnwhFkOtQ/feed" target="_blank" rel="noopener">
                                    <img src="https://www.uaemex.mx/images/2024/Footer/uaemex_tv.png" alt="uaemex tv" width="117" height="53" />
                                </a>
                            </p>
                            <p>
                                <a href="https://criterionoticias.wordpress.com/" target="_blank" rel="noopener">
                                    <img src="https://www.uaemex.mx/images/2024/Footer/LOGO_CRITERIO_web.png" alt=" " width="122" height="34" />
                                </a>
                            </p>
                            <p>
                                <a href="https://appsos.uaemex.mx/sos/" target="_blank" rel="noopener">
                                    <img src="https://www.uaemex.mx/images/2024/Footer/sos.png" alt="sos" width="111" height="52" />
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection