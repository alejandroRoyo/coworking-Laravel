@extends('layouts.app-master')

@section('content')
    <h1 style="font-size: 2rem; font-weight: 700; margin-bottom: 1.5rem;">Hacer una Reserva</h1>

    <form action="{{ route('reservas.store') }}" method="POST" style="display: flex; flex-direction: column; gap: 1rem;">
        @csrf

        <label for="espacio_id" style="font-weight: 600; color: #4a5568;">Espacio:</label>
        <select name="espacio_id" required style="padding: 0.5rem; border: 1px solid #e2e8f0; border-radius: 0.375rem;">
            @foreach ($espacios as $espacio)
                <option value="{{ $espacio->id }}">{{ $espacio->name }}</option>
            @endforeach
        </select>
        
        <label for="fecha" style="font-weight: 600; color: #4a5568;">Fecha:</label>
        <input type="date" name="fecha" required style="padding: 0.5rem; border: 1px solid #e2e8f0; border-radius: 0.375rem;">
        
        <label for="hora_inicio" style="font-weight: 600; color: #4a5568;">Hora de Inicio:</label>
        <input type="time" name="hora_inicio" required style="padding: 0.5rem; border: 1px solid #e2e8f0; border-radius: 0.375rem;">
        
        <label for="hora_fin" style="font-weight: 600; color: #4a5568;">Hora de Fin:</label>
        <input type="time" name="hora_fin" required style="padding: 0.5rem; border: 1px solid #e2e8f0; border-radius: 0.375rem;">

        <button type="submit" style="padding: 0.75rem; background-color: #4CAF50; color: white; border: none; border-radius: 0.375rem; cursor: pointer; transition: background-color 0.3s;">
            Reservar
        </button>
    </form>
@endsection
