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
use App\Http\Controllers\Emails\credencialesController;
use App\Http\Controllers\Emails\EmailsController;
use App\Http\Controllers\Index\IndexController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Firebase\ContactsControler;
use App\Http\Controllers\Maestros\MaestrosController;
use App\Models\Alumno;

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

//rutas maestros
Route::get('index-maestros', [IndexController::class, 'indexMaestros']);
Route::post('guardar-maestros', [MaestrosController::class,'guardarMaestros']);

//rutas invitados
Route::get('index-invitado', [IndexController::class,'indexInvitados']);

//rutas validar correos
Route::post('enviar-correo-alumnos', [EmailsController::class,'enviarCorreoAlumnos']);
Route::post('enviar-correo-maestros', [EmailsController::class,'enviarCorreoMaestros']);
Route::post('codigo-seguridad', [EmailsController::class,'codigoSeguridad']);

//rutas envio de credenciales 
//Route::post('credenciales-alumno',[CredencialesController::class,'enviarCredencialesAlumno']);

//Route::get('indexMaestros', [IndexController::class,'indexMaestros']);
//Route::get('indexInvitado', [IndexController::class,'indexInvitado']);


Route::get('index-guardia', [IndexController::class,'IndexGuardias']);









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
