<?php

use App\Http\Controllers\Apis\ApiController;
use App\Http\Controllers\Apis\ApiLoginController;
use App\Http\Controllers\Apis\ApiPeticionesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/prueba', [ApiController::class, 'index']);
Route::post('/login', [ApiLoginController::class, 'login']);
Route::get('/peticiones/{id}', [ApiPeticionesController::class, 'peticiones']);
Route::post('/aceptar-peticion/{id}', [ApiPeticionesController::class, 'aceptarPeticion']);
Route::post('/rechazar-peticion/{id}', [ApiPeticionesController::class, 'rechazarPeticion']);


