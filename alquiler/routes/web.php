<?php

use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\InquilinoController;
use App\Http\Controllers\PropietarioController;
use App\Http\Controllers\VisitaController;
use Illuminate\Support\Facades\Auth;
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
Route::resource('propietarios',PropietarioController::class);
Route::resource('departamentos',DepartamentoController::class);
Route::resource('inquilinos',InquilinoController::class);
Route::resource('visitas',VisitaController::class);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
