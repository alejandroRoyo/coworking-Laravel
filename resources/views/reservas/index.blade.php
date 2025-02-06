@extends('layouts.app-master')

@section('content')
    <h1 style="font-size: 2rem; font-weight: 700; margin-bottom: 1.5rem;">Mis Reservas</h1>

    @if (session('success'))
        <div style="color: green; margin-bottom: 1rem;">{{ session('success') }}</div>
    @endif

    <a href="{{ route('reservas.create') }}" style="color: #3182ce; font-weight: 600; text-decoration: none; margin-bottom: 1rem; display: inline-block;">
        Hacer una nueva reserva
    </a>

    <table style="width: 100%; border-collapse: collapse; margin-top: 1rem; border: 1px solid #e2e8f0;">
        <thead>
            <tr style="background-color: #f7fafc;">
                <th style="border: 1px solid #e2e8f0; padding: 0.75rem; text-align: left;">Espacio</th>
                <th style="border: 1px solid #e2e8f0; padding: 0.75rem; text-align: left;">Fecha</th>
                <th style="border: 1px solid #e2e8f0; padding: 0.75rem; text-align: left;">Hora de Inicio</th>
                <th style="border: 1px solid #e2e8f0; padding: 0.75rem; text-align: left;">Hora de Fin</th>
                <th style="border: 1px solid #e2e8f0; padding: 0.75rem; text-align: left;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservas as $reserva)
                <tr>
                    <td style="border: 1px solid #e2e8f0; padding: 0.75rem;">{{ $reserva->espacio->name }}</td>
                    <td style="border: 1px solid #e2e8f0; padding: 0.75rem;">{{ $reserva->fecha }}</td>
                    <td style="border: 1px solid #e2e8f0; padding: 0.75rem;">{{ $reserva->hora_inicio }}</td>
                    <td style="border: 1px solid #e2e8f0; padding: 0.75rem;">{{ $reserva->hora_fin }}</td>
                    <td style="border: 1px solid #e2e8f0; padding: 0.75rem;">
                        <form action="{{ route('reservas.destroy', $reserva->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="padding: 0.5rem 1rem; background-color: #e53e3e; color: white; border: none; border-radius: 0.375rem; cursor: pointer; transition: background-color 0.3s;">
                                Cancelar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
