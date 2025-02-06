@extends('layouts.app-master')

@section('content')
    <div style="text-align: center; padding: 40px;">
        @auth
            <h1 style="font-size: 2.5rem; font-weight: bold; color: #333; margin-bottom: 20px;">
                Bienvenido, {{ auth()->user()->name }}
            </h1>
            <p style="font-size: 1.2rem; color: #555; margin-bottom: 20px;">
                Aquí puedes gestionar tus espacios de trabajo y reservas fácilmente.
            </p>
        @else
            <h1 style="font-size: 2.5rem; font-weight: bold; color: #333; margin-bottom: 20px;">
                Bienvenido a Coworking Spaces
            </h1>
            <p style="font-size: 1.2rem; color: #555; margin-bottom: 20px;">
                Reserva espacios de trabajo de manera rápida y sencilla. Elige entre salas de reuniones, oficinas privadas o escritorios compartidos.
            </p>
        @endauth

        <div style="display: flex; justify-content: center; gap: 20px; margin-top: 20px;">
            @guest
                <a href="{{ route('login') }}" 
                   style="background-color: #007bff; color: white; padding: 12px 24px; border-radius: 5px; text-decoration: none; font-weight: bold;">
                    Iniciar Sesión
                </a>
                <a href="{{ route('register') }}" 
                   style="background-color: #28a745; color: white; padding: 12px 24px; border-radius: 5px; text-decoration: none; font-weight: bold;">
                    Registrarse
                </a>
            @else
                <a href="{{ route('espacios.index') }}" 
                   style="background-color: #007bff; color: white; padding: 12px 24px; border-radius: 5px; text-decoration: none; font-weight: bold;">
                    Ver Espacios
                </a>
                <a href="{{ route('reservas.index') }}" 
                   style="background-color: #28a745; color: white; padding: 12px 24px; border-radius: 5px; text-decoration: none; font-weight: bold;">
                    Mis Reservas
                </a>
            @endguest
        </div>
    </div>
@endsection
