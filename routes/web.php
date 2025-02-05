<?php

use App\Http\Controllers\loginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\EspacioController;
use App\Http\Controllers\ReservaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisterController::class, 'show']);;

Route::post('/register', [RegisterController::class, 'register']);;

Route::get('/login', [LoginController::class, 'show']);;

Route::post('/login', [loginController::class, 'login']);;

Route::get('/home', [HomeController::class, 'index']);

Route::get('/logout', [LogoutController::class, 'logout']);

Route::resource('espacios', EspacioController::class)->middleware('auth');
Route::resource('reservas', ReservaController::class)->middleware('auth');
