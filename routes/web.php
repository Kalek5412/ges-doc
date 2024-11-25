<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

/* Route::get('/', function () {
    return view('welcome');
}); */

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index')->middleware('auth');
Route::get('/admin/usuarios', [App\Http\Controllers\UsuarioController::class, 'index'])->name('usuarios.index')->middleware('auth','can:usuarios.index');
Route::get('/admin/usuarios/create', [App\Http\Controllers\UsuarioController::class, 'create'])->name('usuarios.create')->middleware('auth','can:usuarios.create');
Route::post('/admin/usuarios', [App\Http\Controllers\UsuarioController::class, 'store'])->name('usuarios.store')->middleware('auth');
Route::get('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'show'])->name('usuarios.show')->middleware('auth');
Route::get('/admin/usuarios/{id}/edit', [App\Http\Controllers\UsuarioController::class, 'edit'])->name('usuarios.edit')->middleware('auth');
Route::put('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'update'])->name('usuarios.update')->middleware('auth');
Route::delete('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'destroy'])->name('usuarios.destroy')->middleware('auth');

Route::get('/admin/unidad', [App\Http\Controllers\CarpetaController::class, 'index'])->name('unidad.index')->middleware('auth');
Route::post('/admin/unidad', [App\Http\Controllers\CarpetaController::class, 'store'])->name('unidad.store')->middleware('auth');
Route::get('/admin/unidad/carpeta/{id}', [App\Http\Controllers\CarpetaController::class, 'show'])->name('unidad.carpeta')->middleware('auth');
Route::put('/admin/unidad/carpeta', [App\Http\Controllers\CarpetaController::class, 'update_subcarpeta'])->name('unidad.carpeta.update_subcarpeta')->middleware('auth');
Route::put('/admin/unidad/carpeta', [App\Http\Controllers\CarpetaController::class, 'update_subcarpeta_color'])->name('unidad.carpeta.update_subcarpeta_color')->middleware('auth');
Route::post('/admin/unidad/carpeta/crear_subcarpeta', [App\Http\Controllers\CarpetaController::class, 'crear_subcarpeta'])->name('unidad.carpeta.crear_subcarpeta')->middleware('auth');
Route::put('/admin/unidad', [App\Http\Controllers\CarpetaController::class, 'update'])->name('unidad.update')->middleware('auth');
Route::put('/admin/unidad', [App\Http\Controllers\CarpetaController::class, 'update_color'])->name('unidad.update_color')->middleware('auth');
//eliminar carpetas
Route::delete('/admin/unidad/eliminar_carpeta/{id}', [App\Http\Controllers\CarpetaController::class, 'destroy'])->name('carpeta.destroy')->middleware('auth');

Route::post('/admin/unidad/carpeta/upload', [App\Http\Controllers\ArchivoController::class, 'upload'])->name('unidad.archivo.upload')->middleware('auth');
Route::delete('/admin/unidad/carpeta', [App\Http\Controllers\ArchivoController::class, 'delete'])->name('unidad.archivo.delete')->middleware('auth');

//change publico a priva vic
Route::get('/admin/unidad/carpeta', [App\Http\Controllers\ArchivoController::class, 'cambiar_privado_a_publico'])->name('unidad.archivo.cambiar.privado.publico')->middleware('auth');
Route::post('/admin/unidad/carpeta', [App\Http\Controllers\ArchivoController::class, 'cambiar_publico_a_privado'])->name('unidad.archivo.cambiar.publico.privado')->middleware('auth');

//ruta para mostrar archivos priv
Route::get('storage/{carpeta}/{archivo}',function($carpeta,$archivo){
    if(Auth::check()){
        $path=storage_path('app' . DIRECTORY_SEPARATOR. $carpeta . DIRECTORY_SEPARATOR . $archivo);
        if (file_exists($path)) {
            return response()->file($path);
        } else {
            abort(404, 'Archivo no encontrado');
        }
    }else{
        abort (403,'no tiene permiso para acceder a este archivo');
    }

})->name('mostrar.archivos.privados');