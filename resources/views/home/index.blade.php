@extends('layouts.app-master')

@section('content')
    <h1 style="font-size: 2rem; font-weight: 700; margin-bottom: 1.5rem;">Reservas</h1>
    
    @auth
        <form action="{{ route('reservas.store') }}" method="POST" style="display: flex; flex-direction: column; gap: 1rem;">
            @csrf

            <label for="espacio_id" style="font-weight: 600; color: #4a5568;">Selecciona un espacio:</label>
            <select name="espacio_id" id="espacio_id" required style="padding: 0.5rem; border: 1px solid #e2e8f0; border-radius: 0.375rem;">
                @foreach ($espacios as $espacio)
                    <option value="{{ $espacio->id }}">{{ $espacio->name }} - Capacidad: {{ $espacio->capacity }}</option>
                @endforeach
            </select>

            <label for="fecha" style="font-weight: 600; color: #4a5568;">Fecha:</label>
            <input type="date" name="fecha" id="fecha" required style="padding: 0.5rem; border: 1px solid #e2e8f0; border-radius: 0.375rem;">

            <label for="hora_inicio" style="font-weight: 600; color: #4a5568;">Hora de inicio:</label>
            <input type="time" name="hora_inicio" id="hora_inicio" required style="padding: 0.5rem; border: 1px solid #e2e8f0; border-radius: 0.375rem;">

            <label for="hora_fin" style="font-weight: 600; color: #4a5568;">Hora de fin:</label>
            <input type="time" name="hora_fin" id="hora_fin" required style="padding: 0.5rem; border: 1px solid #e2e8f0; border-radius: 0.375rem;">

            <button type="submit" style="padding: 0.75rem; background-color: #3b82f6; color: white; border-radius: 0.375rem; border: none; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#2563eb'" onmouseout="this.style.backgroundColor='#3b82f6'">
                Reservar
            </button>
        </form>
    @else
        <p>Debes <a href="{{ route('login') }}" style="color: #3b82f6;">iniciar sesión</a> para hacer una reserva.</p>
    @endauth

    @guest
        <a href="/login" style="color: #3b82f6;">Iniciar sesión</a>
        <a href="/register" style="color: #3b82f6;">Registrarse</a>
    @endguest
@endsection
