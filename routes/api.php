<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DetalleVentaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\VentaController;
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

Route::get('/venta', [VentaController::class, 'index']);
Route::post('/venta/create', [VentaController::class, 'create']);
Route::post('/venta/update/{id}', [VentaController::class, 'update']);
Route::post('/venta/delete/{id}', [VentaController::class, 'destroy']);


Route::get('/trabajadores', [TrabajadorController::class, 'index']);
Route::post('/trabajadores/create', [TrabajadorController::class, 'create']);
Route::post('/trabajadores/update/{id}', [TrabajadorController::class, 'update']);
Route::post('/trabajadores/delete/{id}', [TrabajadorController::class, 'destroy']);

Route::get('/producto', [ProductoController::class, 'index']);
Route::post('/producto/create', [ProductoController::class, 'create']);
Route::post('/producto/update/{id}', [ProductoController::class, 'update']);
Route::post('/producto/delete/{id}', [ProductoController::class, 'destroy']);

Route::get('/cliente', [ClienteController::class, 'index']);
Route::post('/cliente/create', [ClienteController::class, 'create']);
Route::post('/cliente/update/{id}', [ClienteController::class, 'update']);
Route::post('/cliente/delete/{id}', [ClienteController::class, 'destroy']);

Route::get('/detalleventa', [DetalleVentaController::class, 'index']);
Route::get('/detalleventa/{id}', [DetalleVentaController::class, 'show']);
