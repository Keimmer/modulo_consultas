<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/consulta', [App\Http\Controllers\HomeConsController::class, 'index'])->name('homecons');
Route::get('/especialidades', [\App\Http\Controllers\ConsultaController::class, 'especialidadIndex']);
Route::get('/sintomas', [\App\Http\Controllers\ConsultaController::class, 'sintomasIndex']);
Route::get('/habitos', [\App\Http\Controllers\ConsultaController::class, 'habitosIndex']);
Route::get('/procesos', [\App\Http\Controllers\ConsultaController::class, 'procesosIndex']);
Route::get('/patologias', [\App\Http\Controllers\Patologias::class, 'index']);
Route::get('/esptrat', [\App\Http\Controllers\TratamientosController::class, 'especialidadesTratamientos']);
Route::get('/alltrat', [\App\Http\Controllers\TratamientosController::class, 'getTratamientos']);
Route::get('/getmed', [\App\Http\Controllers\PersonaController::class, 'getMedicos']);
Route::apiResource('/articulos', App\Http\Controllers\ArticuloController::class);
Route::apiResource('/consultas', App\Http\Controllers\ConsultaController::class);
Route::apiResource('/personas', App\Http\Controllers\PersonaController::class);
Route::apiResource('/diagnosticos', App\Http\Controllers\DiagnosticoController::class);
Route::apiResource('/tratamientos', App\Http\Controllers\TratamientosController::class);
Route::apiResource('/recipes', App\Http\Controllers\RecipeController::class);
Route::apiResource('/medicamentos', App\Http\Controllers\MedicamentoController::class);
Route::apiResource('/emergencia', \App\Http\Controllers\EmergenciaController::class);