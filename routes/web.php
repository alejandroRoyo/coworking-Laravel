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

/*
|--------------------------------------------------------------------------
| Rutas Públicas
|--------------------------------------------------------------------------
|
| Estas rutas son accesibles sin autenticación.
|
*/

// Página principal / de bienvenida
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rutas de autenticación
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout'); // Se recomienda usar POST, pero aquí se mantiene GET

// Comentarios
Route::get('/comentarios/create', [ComentarioController::class, 'create'])->name('comentarios.create');
Route::post('/comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');

// Página de contacto
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

/*
|--------------------------------------------------------------------------
| Rutas Protegidas (requieren autenticación)
|--------------------------------------------------------------------------
|
| Aquí se agrupan las rutas a las que solo pueden acceder usuarios autenticados.
|
*/
Route::middleware('auth')->group(function () {

    // Rutas de Espacios
    Route::resource('espacios', EspacioController::class);
    // Ruta adicional para editar espacios en el área de administración
    Route::get('/admin/espacios/{id}/edit', [EspacioController::class, 'edit'])
         ->name('admin.editEspacios');

    // Rutas de Reservas
    Route::resource('reservas', ReservaController::class);
    // Ruta adicional para editar reservas en el área de administración
    Route::get('/admin/reservas/{reserva}/edit', [ReservaController::class, 'edit'])
         ->name('admin.editReservas');
    Route::put('/reservas/{reserva}', [ReservaController::class, 'update'])->name('reservas.update');

    // Panel de Control y Gestión de Usuarios
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.panel');
    Route::get('/admin/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.editUser');
    Route::put('/admin/users/{id}', [AdminController::class, 'updateUser'])->name('admin.updateUser');
    Route::delete('/admin/user/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
});
