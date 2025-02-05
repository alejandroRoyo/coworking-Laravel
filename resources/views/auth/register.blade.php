@extends('layouts.app-master')

@section('content')
    <div class="flex justify-center items-center h-screen bg-gray-100">
        <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-center mb-6">Registro</h2>

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ url('/register') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Nombre</label>
                    <input type="text" name="name" id="name" class="w-full p-2 border rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Correo Electrónico</label>
                    <input type="email" name="email" id="email" class="w-full p-2 border rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Contraseña</label>
                    <input type="password" name="password" id="password" class="w-full p-2 border rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="block text-gray-700">Confirmar Contraseña</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="w-full p-2 border rounded-md" required>
                </div>

                <button type="submit" class="w-full bg-green-500 text-white p-2 rounded-md hover:bg-green-600">
                    Registrarse
                </button>
            </form>

            <p class="mt-4 text-center">
                ¿Ya tienes una cuenta? <a href="{{ url('/login') }}" class="text-blue-500">Iniciar sesión</a>
            </p>
        </div>
    </div>
@endsection
