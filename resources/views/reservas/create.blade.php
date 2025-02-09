@extends('layouts.app-master')

@section('content')
    <h1 style="text-align: center; font-size: 2.5rem; margin-bottom: 20px;">Reservar Asientos</h1>

    <form action="{{ route('reservas.store') }}" method="POST" style="max-width: 600px; margin: 0 auto;">
        @csrf
        <!-- Selección de Espacio -->
        <div style="margin-bottom: 1rem;">
            <label for="espacio_id" style="display: block; margin-bottom: 0.5rem;">Espacio:</label>
            <select name="espacio_id" id="espacio_id" required style="width: 100%; padding: 0.5rem;">
                @foreach ($espacios as $espacio)
                    <option value="{{ $espacio->id }}" {{ (isset($defaultEspacio) && $espacio->id == $defaultEspacio->id) ? 'selected' : '' }}>
                        {{ $espacio->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Fecha de Reserva -->
        <div style="margin-bottom: 1rem;">
            <label for="fecha" style="display: block; margin-bottom: 0.5rem;">Fecha:</label>
            <input type="date" name="fecha" id="fecha" required style="width: 100%; padding: 0.5rem;">
        </div>

        <!-- Selección de Franja Horaria -->
        <div style="margin-bottom: 1rem;">
            <label for="hora_inicio" style="display: block; margin-bottom: 0.5rem;">Hora de Inicio (1 hora):</label>
            <select name="hora_inicio" id="hora_inicio" required style="width: 100%; padding: 0.5rem;">
                @foreach ($slots as $slot)
                    <option value="{{ $slot }}">
                        {{ $slot }} - {{ date("H:i", strtotime($slot . " +1 hour")) }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Mapa/Diagrama de Asientos -->
        <h3 style="margin-top:20px; margin-bottom:10px;">Selecciona los asientos:</h3>
        <div id="seat-map" style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 10px;">
            @foreach ($puestos as $puesto)
                <div style="border: 1px solid #ccc; padding: 10px; text-align: center;">
                    <input type="checkbox" name="puestos[]" value="{{ $puesto->id }}" id="puesto_{{ $puesto->id }}">
                    <label for="puesto_{{ $puesto->id }}">{{ $puesto->label }}</label>
                </div>
            @endforeach
        </div>        

        <button type="submit" style="display: block; width: 100%; padding: 0.75rem; background-color: #007bff; color: white; border: none; border-radius: 5px; margin-top: 20px; cursor: pointer;">
            Reservar
        </button>
    </form>
@endsection
