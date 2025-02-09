<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\EspacioController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ComentarioController;

// Página de bienvenida
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rutas de autenticación
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

// Logout (se define como GET, aunque lo habitual es POST)
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

// Rutas públicas para comentarios y contacto
Route::get('/comentarios/create', [ComentarioController::class, 'create'])->name('comentarios.create');
Route::post('/comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact', function (\Illuminate\Http\Request $request) {
    $data = $request->validate([
        'name'    => 'required|string|max:255',
        'email'   => 'required|email',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
    ]);

    // Aquí podrías procesar el envío (por ejemplo, enviando un email)
    return redirect()->route('contact')->with('success', 'Mensaje enviado correctamente.');
})->name('contact.send');

// Rutas protegidas (accesibles solo para usuarios autenticados)
Route::middleware('auth')->group(function () {
    // Rutas de recursos para espacios y reservas
    Route::resource('espacios', EspacioController::class);
    Route::resource('reservas', ReservaController::class);
    
    // Panel de control y administración de usuarios
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.panel');
    Route::get('/admin/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.editUser');
    Route::put('/admin/users/{id}', [AdminController::class, 'updateUser'])->name('admin.updateUser');
    Route::delete('/admin/user/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
});
