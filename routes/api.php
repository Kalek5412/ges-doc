<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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