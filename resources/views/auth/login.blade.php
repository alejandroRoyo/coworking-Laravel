@extends('layouts.app-master')

@section('content')
<div style="display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f7fafc;">
    <div style="width: 100%; max-width: 28rem; background-color: white; padding: 2rem; border-radius: 0.5rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <h2 style="font-size: 1.5rem; font-weight: 700; text-align: center; margin-bottom: 1.5rem;">Iniciar Sesión</h2>

        @if ($errors->any())
            <div style="background-color: #fecaca; color: #b91c1c; padding: 0.75rem; border-radius: 0.375rem; margin-bottom: 1rem;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('/login') }}" method="POST">
            @csrf

            <div style="margin-bottom: 1rem;">
                <label for="email" style="display: block; color: #4a5568;">Correo Electrónico</label>
                <input type="email" name="email" id="email" style="width: 100%; padding: 0.5rem; border: 1px solid #e2e8f0; border-radius: 0.375rem;" required>
            </div>

            <div style="margin-bottom: 1rem;">
                <label for="password" style="display: block; color: #4a5568;">Contraseña</label>
                <input type="password" name="password" id="password" style="width: 100%; padding: 0.5rem; border: 1px solid #e2e8f0; border-radius: 0.375rem;" required>
            </div>

            <button type="submit" style="width: 100%; background-color: #3b82f6; color: white; padding: 0.5rem; border-radius: 0.375rem; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#2563eb'" onmouseout="this.style.backgroundColor='#3b82f6'">
                Iniciar Sesión
            </button>
        </form>

        <p style="margin-top: 1rem; text-align: center;">
            ¿No tienes una cuenta? <a href="{{ url('/register') }}" style="color: #2563eb;">Regístrate</a>
        </p>
    </div>
</div>
@endsection
