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
Route::get('/schedaore', [App\Http\Controllers\SchedaOreController::class, 'index'])->name("schedaore");
Route::get('/cliente', [App\Http\Controllers\ClienteController::class, 'index'])->name('cliente');
Route::post('/cliente/aggiungi', [App\Http\Controllers\ClienteController::class, 'save'])->name('aggiungicliente');
Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])-> name('user');
Route::post('/user/aggiungi', [App\Http\Controllers\UserController::class, 'save'])-> name('aggiungiutente');
