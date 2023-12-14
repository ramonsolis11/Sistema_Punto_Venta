<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClienteController;

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

Route::get('/', function () {
    return view('welcome');
});

// Rutas para la gestión de categorías
Route::resource('almacen/categoria', CategoriaController::class);

// Rutas para la gestión de productos
Route::resource('almacen/producto', ProductoController::class);

// Rutas para la gestión de clientes
Route::resource('ventas/cliente', ClienteController::class);




