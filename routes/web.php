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

//Route::resource('schedaore', App\Http\Controllers\SchedaOreController::class);
Route::resource('schedaore', App\Http\Controllers\SchedaOreController::class)->except(['show', 'update']);
Route::get('schedaore/{id}', [App\Http\Controllers\SchedaOreController::class,'get']);
Route::put("schedaore/update", [App\Http\Controllers\SchedaOreController::class, 'updateAsync']);



Route::resource('assegnazione', App\Http\Controllers\AssegnazioneController::class);

Route::resource('cliente', App\Http\Controllers\ClienteController::class)->except(['destroy']);
Route::get("cliente/delete/{id}", [App\Http\Controllers\ClienteController::class, 'destroy']);


Route::resource('user', App\Http\Controllers\UserController::class)->except(['destroy']);
Route::get("user/delete/{id}", [App\Http\Controllers\UserController::class, 'destroy']);

Route::resource('progetto', App\Http\Controllers\ProgettoController::class)->except(['destroy']);
Route::get("progetto/delete/{id}", [App\Http\Controllers\ProgettoController::class, 'destroy']);
