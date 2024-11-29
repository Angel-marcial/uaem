<?php
/* 
*
*Codice
*Nombre del Código: web.php
*Fecha de Creación: 15/08/2024 revisado por Angel Geovanni Marcial Morales

*Modificaciones:

*Descripción: Este archivo PHP guarda las rutas de la app
*/

use App\Http\Controllers\Admin\AdminAlumnosController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminGuardiasController;
use App\Http\Controllers\Admin\AdminMaestrosController;
use App\Http\Controllers\Admin\AdminCoordinadoresController;
use App\Http\Controllers\Admin\AdminDepartamentosController;
use App\Http\Controllers\Admin\AdminPeticionesController;
use App\Http\Controllers\Alumnos\AlumnosController;
use App\Http\Controllers\Emails\EmailsController;
use App\Http\Controllers\Index\IndexController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guardias\GuardiasController;
use App\Http\Controllers\Invitados\InvitadosController;
use App\Http\Controllers\Maestros\MaestrosController;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\IngresoSalidaExport;
use App\Http\Controllers\Coordinadores\CoordinadoresController;
use App\Http\Controllers\Emails\InvitacionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//index
Route::get('index', function () {
    return view('index');
});

//rutas alumnos
Route::get('index-alumnos', [IndexController::class,'indexAlumnos']);
Route::post('guardar-alumnos', [AlumnosController::class,'guardarAlumnos']);
Route::get('consulta-alumnos', [AlumnosController::class,'consultaAlumnos'])->middleware('auth.guard')->name('consulta.alumno');
Route::post('editar-alumno/{id}/{usuario}', [AlumnosController::class,'editarAlumno']);
Route::get('alumnos-ingresos', [AlumnosController::class, 'alumnosRegistros'])->name('alumnos.ingresos');
Route::get('alumno-cuenta', [AlumnosController::class, 'informacionAlumno'])->name('alumno-cuenta');
Route::post('editar-alumno/{id}', [AlumnosController::class, 'editarAlumno'])->name('editar.alumno');

//rutas maestros
Route::get('index-maestros', [IndexController::class, 'indexMaestros']);
Route::post('guardar-maestros', [MaestrosController::class,'guardarMaestros']);
Route::get('consulta-maestros', [MaestrosController::class, 'consultaMaestros'])->middleware('auth.guard')->name('consulta.maestros');
Route::post('editar-maestro/{id}', [MaestrosController::class,'editarMaestro']); 
Route::get('maestros-horarios', [MaestrosController::class, 'consultaMaestrosHorarios'])->name('maestros.horarios.horarios');
Route::get('maestros-cuenta', [MaestrosController::class, 'informacionMaestros']);
Route::get('maestros-clases',[MaestrosController::class, 'consultaClases']);
Route::post('editar-maestro/{id}', [MaestrosController::class, 'editarMaestro'])->name('editar-maestro');
Route::post('editar-horario', [MaestrosController::class, 'editarHorario'])->name('editar-horario');
//rutas Coordinador
Route::get('consulta-coordinadores', [CoordinadoresController::class,'consultaCoordinadores'])->middleware('auth.guard');
Route::get('coordinador-consulta-peticiones', [CoordinadoresController::class,'coordinadorVerPeticiones'])->middleware('auth.guard');
Route::get('cordinador-registros', [CoordinadoresController::class, 'coordinadoresRegistros'])->name('coordinador.registros.registro');
Route::get('cordinador-horarios',[CoordinadoresController::class, 'coordinadoresHorarios'])->name('coordinador.horarios.horario');
Route::get('cordinador-cuenta',[CoordinadoresController::class, 'coordinadoresCuenta'])->name('coordinador.cuentas.cuenta');
Route::post('editar-horarioC', [CoordinadoresController::class, 'editarHorarioC'])->name('editar-horario');
Route::post('editar-cuenta', [CoordinadoresController::class, 'editarCordinador'])->name('editar-cordinador');
//rutas administrador 
Route::get('index-admin',[AdminController::class, 'consultaAdmin'])->middleware('auth.guard')->name('guardias.index');
Route::post('editar-admin/{id}', [AdminController::class,'editarAdmin'])->middleware('auth.guard');
Route::get('admin-dashboard',[AdminController::class,'dashboard'])->middleware('auth.guard');
//admin alumnos 
Route::get('admin-consulta-alumnos', [AdminController::class,'tablaAlumos'])->middleware('auth.guard');
Route::get('admin-buscar-alumnos', [AdminController::class,'buscarAlumos'])->middleware('auth.guard');
Route::get('admin-elimina-alumnos/{cuenta}', [AdminController::class,'eliminarAlumno'])->middleware('auth.guard');
Route::get('admin-ver-alumnos/{cuenta}', [AdminController::class,'datosAlumno'])->middleware('auth.guard');
Route::get('admin-nuevo-alumno', [AdminAlumnosController::class,'adminNuevoAlumno'])->middleware('auth.guard');
Route::post('admin-alta-alumno', [AdminAlumnosController::class,'nuevoAlumno'])->middleware('auth.guard');
Route::post('actualizar-estatus-alumno/{id}', [AdminAlumnosController::class, 'actualizarEstatus']); 
//admin maestros 
Route::get('admin-consulta-maestros', [AdminMaestrosController::class,'tablaMaestros'])->middleware('auth.guard');
Route::get('admin-buscar-maestros', [AdminMaestrosController::class,'buscarMaestros'])->middleware('auth.guard'); 
Route::get('admin-elimina-maestro/{cuenta}', [AdminMaestrosController::class,'eliminarMaestro'])->middleware('auth.guard');
//admin guardias
Route::get('admin-consulta-guardias', [AdminGuardiasController::class,'tablaGuardias'])->middleware('auth.guard');
Route::get('admin-buscar-guardias', [AdminGuardiasController::class,'buscarGuardias'])->middleware('auth.guard'); 
Route::get('admin-elimina-guardia/{cuenta}', [AdminGuardiasController::class,'eliminarGuardia'])->middleware('auth.guard');
Route::get('admin-nuevo-guardia', [AdminGuardiasController::class,'adminNuevoGuardia'])->middleware('auth.guard');
Route::post('admin-alta-guardia', [AdminGuardiasController::class,'nuevoMaestro'])->middleware('auth.guard');
Route::get('admin-ver-guardia/{cuenta}', [AdminGuardiasController::class,'datosGuardia'])->middleware('auth.guard'); 
Route::post('editar-guardia/{id}', [AdminGuardiasController::class,'editarGuardia'])->middleware('auth.guard');
//admin coordinadores
Route::get('admin-consulta-coordinador', [AdminCoordinadoresController::class,'tablaCoordinadores'])->middleware('auth.guard');
Route::get('admin-buscar-coordinador', [AdminCoordinadoresController::class,'buscarCoordinador'])->middleware('auth.guard');
Route::get('admin-nuevo-coordinador', [AdminCoordinadoresController::class,'adminNuevoCordinador'])->middleware('auth.guard');
Route::post('admin-nuevo-departamento/{interfaz}', [AdminDepartamentosController::class,'nuevoDepartamento'])->middleware('auth.guard');
Route::get('admin-elimina-departamento/{id}', [AdminDepartamentosController::class,'eliminarDepartamento'])->middleware('auth.guard');
Route::get('admin-ver-departamento/{cuenta}', [AdminDepartamentosController::class,'datosDepartamento'])->middleware('auth.guard');
Route::post('admin-edita-departamento/{id}/{idUsuario}', [AdminDepartamentosController::class,'editarDepartamento'])->middleware('auth.guard'); 
//admin peticiones
Route::get('admin-consulta-peticiones', [AdminPeticionesController::class,'adminVerPeticiones'])->middleware('auth.guard');  //--trabajando
Route::post('enviar-correo-invitacion/{id}', [InvitacionController::class,'EnviarQr'])->middleware('auth.guard'); 
Route::post('admin-cancela-invitacion/{id}', [InvitacionController::class,'cancelaInvitacion'])->middleware('auth.guard');
//rutas invitados
Route::get('index-invitado', [IndexController::class,'indexInvitados']);
Route::post('crear-invitado', [InvitadosController::class,'crearInvitacion']);  







//rutas validar correos
Route::post('enviar-correo-alumnos', [EmailsController::class,'enviarCorreoAlumnos']);
Route::post('enviar-correo-maestros', [EmailsController::class,'enviarCorreoMaestros']);
Route::post('codigo-seguridad', [EmailsController::class,'codigoSeguridad']);

//ruras login
Route::post('login', [IndexController::class, 'login']);

//rutas guardia
Route::get('index-guardia', [GuardiasController::class, 'indexGuardias'])->middleware('auth.guard')->name('guardias.index');
//Route::post('guardar-entradas-salidas', [GuardiasController::class, 'guardarEntradasSalidas']);//--trabajando
Route::post('guardar-entradas-salidas', [GuardiasController::class, 'guardarEntradasSalidas'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);


//ruta para cerrar session
Route::post('cerrar-session', [IndexController::class, 'cerrarSession']);   


//expprtaciones 
Route::get('export/ingreso-salida', function (Request $request) {
    return Excel::download(
        new IngresoSalidaExport(
            session('id'), 
            $request->input('option'), 
            $request->input('day'), 
            $request->input('start_date'), 
            $request->input('end_date')
        ), 
        'ingreso_salida.xlsx'
    );
})->name('export.ingreso_salida');