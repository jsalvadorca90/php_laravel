<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EjemploController;
use App\Http\Controllers\ApiCategoriasController;
use App\Http\Controllers\ApiProductosController;
use App\Http\Controllers\ApiProductosFotosController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resource('v1/ejemplo', EjemploController::class);
Route::resource('v1/categorias', ApiCategoriasController::class);
Route::resource('v1/productos', ApiProductosController::class);
Route::resource('v1/productos-fotos', ApiProductosFotosController::class);
