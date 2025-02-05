@extends('layouts.app-master')

@section('content')
    <h1>Reservas</h1>
    @auth
        <form action="{{ route('reservas.store') }}" method="POST">
            @csrf

            <label for="espacio_id">Selecciona un espacio:</label>
            <select name="espacio_id" id="espacio_id" required>
                @foreach ($espacios as $espacio)
                    <option value="{{ $espacio->id }}">{{ $espacio->name }} - Capacidad: {{ $espacio->capacity }}</option>
                @endforeach
            </select>
            <br>

            <label for="fecha">Fecha:</label>
            <input type="date" name="fecha" id="fecha" required>
            <br>

            <label for="hora_inicio">Hora de inicio:</label>
            <input type="time" name="hora_inicio" id="hora_inicio" required>
            <br>

            <label for="hora_fin">Hora de fin:</label>
            <input type="time" name="hora_fin" id="hora_fin" required>
            <br>

            <button type="submit">Reservar</button>
        </form>
    @else
        <p>Debes <a href="{{ route('login') }}">iniciar sesión</a> para hacer una reserva.</p>
    @endauth

    @guest
        <a href="/login">Iniciar sesión</a>
        <a href="/register">Registrarse</a>
    @endguest
@endsection
