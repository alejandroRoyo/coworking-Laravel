@extends('layouts.app-master')

@section('content')
    <!-- Sección 1: Pantalla completa con fondo de imagen -->
    <div
        style="height: 100vh; background: url('/coworking.webp') no-repeat center center/cover; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; padding: 20px; margin: 0 -20px; width: calc(100% + 40px);">
        <div style="background-color: rgba(255, 255, 255, 0.7); padding: 20px; border-radius: 10px;">
            @auth
                <h1 style="font-size: 2.5rem; font-weight: bold; color: #333; margin-bottom: 20px;">
                    Bienvenido, {{ auth()->user()->name }}
                </h1>
                <p style="font-size: 1.2rem; color: #555; margin-bottom: 20px;">
                    Aquí puedes gestionar tus espacios de trabajo y reservas fácilmente.
                </p>
            @else
                <h1 style="font-size: 2.5rem; font-weight: bold; color: #333; margin-bottom: 20px;">
                    Bienvenido a LaboraSpace
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
        </div>
    </div>

    <!-- Sección 2: Contenido adicional (texto e imagen) -->
    <div style="padding: 40px; background-color: #f3f4f6;">
        <div style="display: flex; align-items: center; gap: 20px; max-width: 1200px; margin: 0 auto;">
            <div style="flex: 1;">
                <p style="font-size: 1.2rem; color: #555;">
                    En Labora Space creemos en la creatividad, la colaboración y el crecimiento. Ofrecemos un ambiente
                    moderno y flexible diseñado para profesionales, emprendedores y equipos que buscan un lugar inspirador
                    donde desarrollar sus ideas.
                </p>
            </div>
            <div style="flex: 1;">
                <img src="coworking.webp" style="max-width: 100%; height: auto;" alt="Imagen de coworking">
            </div>
        </div>
    </div>

    <!-- Sección 3: Mapa y Cómo Llegar -->
    <div
        style="display: flex; flex-wrap: wrap; gap: 20px; padding: 40px; background-color: #e5e7eb; max-width: 1200px; margin: 0 auto;">
        <div style="flex: 1; min-width: 300px;">
            <h2 style="font-size: 1.75rem; font-weight: bold; margin-bottom: 10px;">Ubicación</h2>
            <div style="width: 100%; height: 400px;"> <!-- Aumenté la altura del mapa a 400px -->
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3079.296761255105!2d-0.3957059236137058!3d39.48521311180664!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd6045f5783e389f%3A0xf49baca884105343!2s%5BIES%5D%20Instituto%20de%20Educaci%C3%B3n%20Secundaria%20Conseller%C3%ADa!5e0!3m2!1ses!2ses!4v1739281386298!5m2!1ses!2ses"
                    width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
        <div style="flex: 1; min-width: 300px; display: flex; align-items: center;">
            <div>
                <h2 style="font-size: 1.75rem; font-weight: bold; margin-bottom: 10px;">Cómo Llegar</h2>
                <p style="font-size: 1.2rem; color: #555;">
                    <strong>Metro:</strong> Estación Campanar (Líneas 1 y 2) <br>
                    <strong>Autobús:</strong> Líneas 62, 64, 92, 99, L121A, L135A, L140B y L141 <br>
                    <strong>Dirección:</strong> Carrer del Monestir de Poblet, s/n, Campanar, 46015 València, Valencia
                </p>
            </div>
        </div>
    </div>

    <!-- Sección 4: Comentarios -->
    <div
        style="margin-top: 40px; padding: 20px; background-color: #f9fafb; border-top: 1px solid #e2e8f0; border-radius: 8px; max-width: 1200px; margin-left: auto; margin-right: auto;">
        <h2 style="font-size: 2rem; font-weight: bold; color: #333; margin-bottom: 20px;">Comentarios de Clientes</h2>

        <!-- Botón "Añadir comentario" antes de la lista de comentarios -->
        <div style="text-align: center; margin-bottom: 20px;">
            <a href="{{ route('comentarios.create') }}"
                style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px; transition: background-color 0.3s;">
                Añadir Comentario
            </a>
        </div>

        @if ($comentarios->count() > 0)
            <div style="display: flex; flex-direction: column; gap: 1rem;">
                @foreach ($comentarios as $comentario)
                    <div
                        style="background-color: white; padding: 1rem; border: 1px solid #e2e8f0; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05); text-align: left;">
                        <div
                            style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                            <p style="font-weight: bold; color: #333; margin: 0;">{{ $comentario->nombre ?? 'Anónimo' }}</p>
                            <p style="font-size: 0.8rem; color: #777; margin: 0;">
                                {{ $comentario->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <p
                            style="color: #555; margin-bottom: 0.5rem; white-space: pre-wrap; word-wrap: break-word; text-align: left;">
                            {{ $comentario->comentario }}
                        </p>
                        <div style="color: #ffc107;">
                            @for ($i = 0; $i < $comentario->estrellas; $i++)
                                ★
                            @endfor
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p style="color: #888; text-align: center;">No hay comentarios.</p>
        @endif
    </div>
@endsection