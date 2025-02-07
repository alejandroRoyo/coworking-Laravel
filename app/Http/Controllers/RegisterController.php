<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function show(){
        if (Auth::check()) {
            return redirect('/home');
        }
        return view('auth.register');
    }

    public function register(RegisterRequest $request){
        // Crear el usuario con los datos validados
        $user = User::create($request->validated());

        // Iniciar sesión automáticamente con el nuevo usuario
        Auth::login($user);

        // Redirigir a la página principal o a donde desees
        return redirect('/home')->with('success', 'Registro exitoso. ¡Bienvenido ' . $user->name . '!');
    }
}
