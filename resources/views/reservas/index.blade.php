@extends('layouts.app-master')

@section('content')
    <h1 style="font-size: 2rem; font-weight: 700; margin-bottom: 1.5rem;">Mis Reservas</h1>

    @if (session('success'))
        <div style="color: green; margin-bottom: 1rem;">{{ session('success') }}</div>
    @endif

    <a href="{{ route('reservas.create') }}" style="color: #3182ce; font-weight: 600; text-decoration: none; margin-bottom: 1rem; display: inline-block;">
        Hacer una nueva reserva
    </a>

    <div id="reservas-container" style="display: flex; flex-wrap: wrap; gap: 1rem; margin-top: 1rem;">
        @foreach ($reservas as $reserva)
            <div class="reserva" 
                 data-id="{{ $reserva->id }}"
                 data-espacio="{{ $reserva->espacio->name }}"
                 data-fecha="{{ $reserva->fecha }}"
                 data-hora_inicio="{{ $reserva->hora_inicio }}"
                 data-hora_fin="{{ $reserva->hora_fin }}"
                 style="border: 1px solid #e2e8f0; padding: 1rem; border-radius: 0.375rem; width: calc(33.33% - 1rem); background-color: #f7fafc;">
                <h3 style="font-size: 1.25rem; font-weight: 600;">{{ $reserva->espacio->name }}</h3>
                <p><strong>Fecha:</strong> {{ $reserva->fecha }}</p>
                <p><strong>Hora de inicio:</strong> {{ $reserva->hora_inicio }}</p>
                <p><strong>Hora de fin:</strong> {{ $reserva->hora_fin }}</p>

                <div style="display: flex; gap: 0.5rem; margin-top: 1rem;">
                    <!-- Botón Editar -->
                    <a href="{{ route('reservas.edit', $reserva->id) }}" 
                       style="padding: 0.5rem 1rem; background-color: #3182ce; color: white; text-decoration: none; border-radius: 0.375rem;">
                        Editar
                    </a>
                    <!-- Botón Cancelar -->
                    <form action="{{ route('reservas.destroy', $reserva->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                style="padding: 0.5rem 1rem; background-color: #e53e3e; color: white; border: none; border-radius: 0.375rem; cursor: pointer; transition: background-color 0.3s;">
                            Cancelar
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
