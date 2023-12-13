<?php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\VentaDetalleController;
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



Route::post('/usuario/login', [UserController::class, 'login']);



Route::middleware('auth:sanctum')->group(function () {

    Route::get('/usuarios', [UserController::class, 'index']);
    Route::post('/usuario/guardar', [UserController::class, 'store']);
    Route::get('/usuario/mostrar/{user}', [UserController::class, 'show']);
    Route::get('/usuario/mostrar', [UserController::class, 'mostrar']);
    Route::put('/usuario/editar/{user}', [UserController::class, 'update']);
    Route::delete('/usuario/borrar/{user}', [UserController::class, 'destroy']);
    Route::get('/usuario/logout', [UserController::class, 'logout']);

    Route::get('/productos', [ProductoController::class, 'index']);
    Route::post('/producto/guardar', [ProductoController::class, 'store']);
    Route::get('/producto/mostrar/{producto}', [ProductoController::class, 'show']);
    Route::put('/producto/editar/{producto}', [ProductoController::class, 'update']);
    Route::put('/producto/editar2', [ProductoController::class, 'update2']);
    Route::delete('/producto/borrar/{producto}', [ProductoController::class, 'destroy']);
    Route::get('/producto/buscar/{name}', [ProductoController::class, 'buscar']);
    Route::get('/producto/crear', [ProductoController::class, 'create']);

    Route::get('/ventas', [VentaController::class, 'index']);
    Route::post('/venta/guardar', [VentaController::class, 'store']);
    Route::get('/venta/mostrar/{venta}', [VentaController::class, 'show']);
    Route::put('/venta/editar/{venta}', [VentaController::class, 'update']);
    Route::delete('/venta/borrar/{venta}', [VentaController::class, 'destroy']);
    Route::get('/venta/detalle/{id}', [VentaController::class, 'show_detail']);
    Route::get('/venta/buscar/{fecha1}/{fecha2?}', [VentaController::class, 'buscar']);

    //Route::get('/detalles',[VentaDetalleController::class,'index']);
    Route::post('/detalle/guardar', [VentaDetalleController::class, 'store']);
    Route::get('/detalle/mostrar/{ventaDetalle}', [VentaDetalleController::class, 'show']);
    Route::put('/detalle/editar/{ventaDetalle}', [VentaDetalleController::class, 'update']);
    Route::delete('/detalle/borrar/{ventaDetalle}', [VentaDetalleController::class, 'destroy']);
    //Route::get('/detalle/crear',[VentaDetalleController::class,'create']);
});
