<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonasController;
use App\Http\Controllers\DomiciliosController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('personas')->group(function(){

    Route::put('/crear',[PersonasController::class, 'crear']);
    Route::delete('/borrar/{id}',[PersonasController::class, 'borrar']);
    Route::post('/editar/{id}', [PersonasController::class, 'editar']);
    Route::get('/listar_personas', [PersonasController::class, 'listar_personas']);
    Route::get('/ver_persona/{id}', [PersonasController::class, 'ver_persona']);

});


Route::prefix('domicilios')->group(function(){

    Route::put('/crear',[DomiciliosController::class, 'crear']);
    Route::delete('/borrar/{id}',[DomiciliosController::class, 'borrar']);
    Route::post('/editar/{id}', [DomiciliosController::class, 'editar']);
    Route::get('/verporNumero', [DomiciliosController::class, 'verporNumero']);
    Route::get('/ver/{id}', [DomiciliosController::class, 'ver']);

});




