@extends('layouts.app-master')

@section('content')
    <h1 style="font-size: 2rem; font-weight: 700; margin-bottom: 1.5rem;">Editar Reserva</h1>

    @if ($errors->any())
        <div style="color: red; margin-bottom: 1rem;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('reservas.update', $reserva->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="espacio_id" style="display: block; margin-bottom: 0.5rem;">Espacio:</label>
        <select name="espacio_id" id="espacio_id" style="padding: 0.5rem; margin-bottom: 1rem; width: 100%;">
            @foreach ($espacios as $espacio)
                <option value="{{ $espacio->id }}" {{ $reserva->espacio_id == $espacio->id ? 'selected' : '' }}>
                    {{ $espacio->name }} - Capacidad: {{ $espacio->capacity }}
                </option>
            @endforeach
        </select>

        <label for="fecha" style="display: block; margin-bottom: 0.5rem;">Fecha:</label>
        <input type="date" name="fecha" id="fecha" value="{{ $reserva->fecha }}" style="padding: 0.5rem; margin-bottom: 1rem; width: 100%;" required>

        <label for="hora_inicio" style="display: block; margin-bottom: 0.5rem;">Hora de inicio:</label>
        <input type="time" name="hora_inicio" id="hora_inicio" value="{{ $reserva->hora_inicio }}" style="padding: 0.5rem; margin-bottom: 1rem; width: 100%;" required>

        <label for="hora_fin" style="display: block; margin-bottom: 0.5rem;">Hora de fin:</label>
        <input type="time" name="hora_fin" id="hora_fin" value="{{ $reserva->hora_fin }}" style="padding: 0.5rem; margin-bottom: 1rem; width: 100%;" required>

        <button type="submit" style="padding: 0.75rem; background-color: #3182ce; color: white; border: none; border-radius: 0.375rem; cursor: pointer;">
            Actualizar Reserva
        </button>
    </form>
@endsection
