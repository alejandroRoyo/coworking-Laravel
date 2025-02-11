@extends('layouts.app-master')

@section('content')
    <h1 style="text-align: center; font-size: 2.5rem; font-weight: bold; margin-bottom: 20px;">
        Editar Reserva
    </h1>

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

        <!-- Fecha -->
        <div style="margin-bottom: 1rem;">
            <label for="fecha" style="display: block; margin-bottom: 0.5rem;">Fecha:</label>
            <input type="date" name="fecha" id="fecha" value="{{ $reserva->fecha }}" required 
                   style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 5px;">
        </div>

        <!-- Hora de Inicio -->
        <div style="margin-bottom: 1rem;">
            <label for="hora_inicio" style="display: block; margin-bottom: 0.5rem;">Hora de Inicio:</label>
            <input type="time" name="hora_inicio" id="hora_inicio" value="{{ $reserva->hora_inicio }}" required 
                   style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 5px;">
        </div>

        <!-- Nota: La hora de fin se calculará automáticamente en el controlador -->

        <button type="submit" 
                style="display: block; width: 100%; padding: 0.75rem; background-color: #3182ce; color: white; border: none; border-radius: 5px; cursor: pointer; margin-bottom: 1rem;">
            Guardar Cambios
        </button>

        <a href="{{ route('admin.panel') }}" 
           style="display: block; text-align: center; color: #3182ce; text-decoration: none;">
            Volver al Panel de Control
        </a>
    </form>
@endsection
