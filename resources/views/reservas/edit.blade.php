@extends('layouts.app-master')

@section('content')
    <h1 style="text-align: center; font-size: 2.5rem; margin-bottom: 20px;">Editar Reserva</h1>

    @if ($errors->any())
        <div style="color: red; margin-bottom: 1rem;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('reservas.update', $reserva->id) }}" method="POST" style="max-width: 600px; margin: 0 auto;">
        @csrf
        @method('PUT')
        
        <!-- Selección de Espacio -->
        <div style="margin-bottom: 1rem;">
            <label for="espacio_id" style="display: block; margin-bottom: 0.5rem;">Espacio:</label>
            <select name="espacio_id" id="espacio_id" required style="width: 100%; padding: 0.5rem;">
                @foreach ($espacios as $espacio)
                    <option value="{{ $espacio->id }}" {{ $reserva->espacio_id == $espacio->id ? 'selected' : '' }}>
                        {{ $espacio->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Fecha de Reserva -->
        <div style="margin-bottom: 1rem;">
            <label for="fecha" style="display: block; margin-bottom: 0.5rem;">Fecha:</label>
            <input type="date" name="fecha" id="fecha" value="{{ $reserva->fecha }}" required style="width: 100%; padding: 0.5rem;">
        </div>

        <!-- Selección de Franja Horaria -->
        <div style="margin-bottom: 1rem;">
            <label for="hora_inicio" style="display: block; margin-bottom: 0.5rem;">Hora de Inicio (1 hora):</label>
            <select name="hora_inicio" id="hora_inicio" required style="width: 100%; padding: 0.5rem;">
                @foreach ($slots as $slot)
                    <option value="{{ $slot }}" {{ $reserva->hora_inicio == $slot ? 'selected' : '' }}>
                        {{ $slot }} - {{ date("H:i", strtotime($slot . " +1 hour")) }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" style="display: block; width: 100%; padding: 0.75rem; background-color: #3182ce; color: white; border: none; border-radius: 5px; margin-top: 20px; cursor: pointer;">
            Actualizar Reserva
        </button>
    </form>
@endsection
