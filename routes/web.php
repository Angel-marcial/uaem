<?php
/* 
*
*Codice
*Nombre del Código: web.php
*Fecha de Creación: 15/08/2024 revisado por Angel Geovanni Marcial Morales

*Modificaciones:

*Descripción: Este archivo PHP guarda las rutas de la app
*/
use App\Http\Controllers\Alumnos\AlumnosController;
use App\Http\Controllers\Emails\EmailsController;
use App\Http\Controllers\Index\IndexController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guardias\GuardiasController;
use App\Http\Controllers\Maestros\MaestrosController;
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

/*
Route::get('contacts', [ContactsControler::class,'index']);
Route::get('add-contact', [ContactsControler::class,'create']);
Route::post('add-contact', [ContactsControler::class,'store']);
Route::get('edit-contact/{id}', [ContactsControler::class,'edit']);
Route::put('update-contact/{id}', [ContactsControler::class,'update']);
Route::get('delete-contact/{id}', [ContactsControler::class,'delete']);
*/

//index
Route::get('index', function () {
    return view('index');
});

//rutas alumnos
Route::get('index-alumnos', [IndexController::class,'indexAlumnos']);
Route::post('guardar-alumnos', [AlumnosController::class,'guardarAlumnos']);
Route::get('consulta-alumnos', [AlumnosController::class,'consultaAlumnos'])->middleware('auth.guard')->name('consulta.alumno');
Route::post('editar-alumno/{id}', [AlumnosController::class,'editarAlumno']);

//rutas maestros
Route::get('index-maestros', [IndexController::class, 'indexMaestros']);
Route::post('guardar-maestros', [MaestrosController::class,'guardarMaestros']);
Route::get('consulta-maestros', [MaestrosController::class, 'consultaMaestros'])->middleware('auth.guard')->name('consulta.maestros');

//rutas invitados
Route::get('index-invitado', [IndexController::class,'indexInvitados']);

//rutas validar correos
Route::post('enviar-correo-alumnos', [EmailsController::class,'enviarCorreoAlumnos']);
Route::post('enviar-correo-maestros', [EmailsController::class,'enviarCorreoMaestros']);
Route::post('codigo-seguridad', [EmailsController::class,'codigoSeguridad']);

//zona de prueba
Route::post('login', [IndexController::class, 'login']);

Route::get('index-guardia', [GuardiasController::class, 'indexGuardias'])
->middleware('auth.guard')
->name('guardias.index');

Route::post('cerrar-session', [IndexController::class, 'cerrarSession']);   
//Route::post('alumnos', [AlumnosController::class, 'store'])->name('alumnos.store');

/*
Route::get('/', function () {
    return view('index');
});
*/

/*
Route::get('/', function () {
    return view('welcome');
});
*/
