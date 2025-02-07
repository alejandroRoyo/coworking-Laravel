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
                Reserva espacios de trabajo de manera rápida y sencilla. Elige entre salas de reuniones, oficinas privadas o
                escritorios compartidos.
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
        <div style="width: 100%; height: 400px; margin: 20px auto;">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1088.7094786530292!2d-0.39370689090343003!3d39.484340037630155!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd6045f5783e389f%3A0xf49baca884105343!2s%5BIES%5D%20Instituto%20de%20Educaci%C3%B3n%20Secundaria%20Conseller%C3%ADa!5e0!3m2!1ses!2ses!4v1738928900983!5m2!1ses!2ses"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <!-- Sección de Comentarios -->
        <div style="margin-top: 40px; padding: 20px; border-top: 1px solid #ccc;">
            <h2 style="font-size: 2rem; font-weight: bold; margin-bottom: 20px;">Comentarios de Clientes</h2>

            @if ($comentarios->count() > 0)
                @foreach ($comentarios as $comentario)
                    <div style="margin-bottom: 20px; padding: 10px; border: 1px solid #e2e8f0; border-radius: 5px;">
                        <p style="font-weight: bold;">{{ $comentario->nombre ?? 'Anónimo' }}</p>
                        <p>{{ $comentario->comentario }}</p>
                        <p style="font-size: 0.8rem; color: #777;">{{ $comentario->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                @endforeach
            @else
                <p style="color: #888;">No hay comentarios.</p>
            @endif

            <!-- Botón para añadir un comentario -->
            <a href="{{ route('comentarios.create') }}"
                style="display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;">
                Añadir Comentario
            </a>
        </div>
    </div>
@endsection
