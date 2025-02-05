@extends('layouts.app-master')

@section('content')
    <h1>Hacer una Reserva</h1>

    <form action="{{ route('reservas.store') }}" method="POST">
        @csrf
        <label for="espacio_id">Espacio:</label>
        <select name="espacio_id" required>
            @foreach ($espacios as $espacio)
                <option value="{{ $espacio->id }}">{{ $espacio->name }}</option>
            @endforeach
        </select>
        <br>

        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" required>
        <br>

        <label for="hora_inicio">Hora de Inicio:</label>
        <input type="time" name="hora_inicio" required>
        <br>

        <label for="hora_fin">Hora de Fin:</label>
        <input type="time" name="hora_fin" required>
        <br>

        <button type="submit">Reservar</button>
    </form>
@endsection
