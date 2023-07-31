<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CadenasController;
use App\Http\Controllers\FechasController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\GeneracionAleatoriaController;
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
    return view('index');
})->name('index');

// Ruta para mostrar la vista "texto.blade.php" con el texto original
Route::get('/mostrar-texto', [CadenasController::class, 'mostrarTexto'])->name('mostrarTexto');

// Ruta para procesar la acción de contar caracteres y mostrar el resultado
Route::post('/accion-texto', [CadenasController::class, 'accionTexto'])->name('accionTexto');

// Ruta para procesar la acción de convertir el texto a minúsculas
Route::post('/accion-minusculas', [CadenasController::class, 'accionTexto'])->name('accionMinusculas');

// Ruta para procesar la acción de mostrar texto original
Route::post('/accion-original', [CadenasController::class, 'accionTexto'])->name('accionOriginal');

// Ruta para procesar la acción de palabras repetidas
Route::post('/accion-repetidas', [CadenasController::class, 'accionTexto'])->name('accionRepetidas');

// Ruta para procesar la acción de reemplazar palabra "Proconsi" por "Isnocorp"
Route::post('/accion-reemplazar', [CadenasController::class, 'accionTexto'])->name('accionReemplazar');

// Ruta para procesar la acción de concatenar texto 1000 veces
Route::post('/accion-concatenar', [CadenasController::class, 'accionTexto'])->name('accionConcatenar');

// Ruta para mostrar el formulario de fechas
Route::get('/fechas', [FechasController::class, 'fechas'])->name('fechas');

// Ruta para procesar el formulario y ejecutar la acción según el botón presionado
Route::post('/fechas', [FechasController::class, 'procesarFormulario'])->name('fechas.procesar');

// Rutas para itemSeparator
// Ruta para mostrar el formulario de creación de instancia
Route::get('/main', [ItemController::class, 'mostrarVista'])->name('formularioClases');

// Ruta para procesar el formulario y crear la instancia de ItemSeparator
Route::post('/instanciarItem', [ItemController::class, 'instanciarItem'])->name('instanciarItem');

// Ruta para mostrar la vista de generación aleatoria
Route::get('/aleatoria/generacionAleatoria', [GeneracionAleatoriaController::class, 'mostrarVista'])
    ->name('generacionAleatoria');

// Ruta para procesar el formulario y generar las formas aleatorias
Route::post('/aleatoria/generarFormas', [GeneracionAleatoriaController::class, 'generarFormas'])
    ->name('generarFormas');
