@extends('layouts.app-master')

@section('content')
    <h1 style="font-size: 1.875rem; font-weight: 700; margin-bottom: 1rem;">Lista de Espacios</h1>

    @if (session('success'))
        <div style="margin-top: 1rem; padding: 0.75rem; background-color: #d1fae5; color: #16a34a; border-radius: 0.375rem;">
            {{ session('success') }}
        </div>
    @endif

    <div id="espacios-container" style="display: flex; flex-wrap: wrap; gap: 1.5rem; margin-top: 1.5rem;">
        @foreach ($espacios as $espacio)
            <div class="espacio" 
                style="border: 1px solid #d1d5db; border-radius: 0.375rem; padding: 1rem; width: calc(33.333% - 1rem); box-sizing: border-box;"
                data-id="{{ $espacio->id }}"
                data-nombre="{{ $espacio->name }}"
                data-capacidad="{{ $espacio->capacity }}"
                data-precio="{{ $espacio->precio_por_hora }}">
                <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.5rem;">{{ $espacio->name }}</h2>
                <p style="color: #4b5563; margin-bottom: 0.5rem;">{{ $espacio->description }}</p>
                <p style="color: #4b5563; margin-bottom: 0.5rem;">
                    Capacidad: <strong>{{ $espacio->capacity }}</strong>
                </p>
                <p style="color: #4b5563; margin-bottom: 0.5rem;">
                    Precio por hora: <strong>{{ $espacio->precio_por_hora }} €</strong>
                </p>
                <!-- Al pulsar "Reservar", se redirige al formulario de reserva con el espacio seleccionado -->
                <button onclick="window.location.href='{{ route('reservas.create') }}?espacio_id={{ $espacio->id }}'" 
                        style="background-color: #3b82f6; color: white; padding: 0.5rem 1rem; border: none; border-radius: 0.375rem; cursor: pointer;">
                    Reservar
                </button>
            </div>
        @endforeach
    </div>
@endsection
