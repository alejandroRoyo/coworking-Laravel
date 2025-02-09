@extends('layouts.app-master')

@section('content')
    <h1 style="font-size: 1.875rem; font-weight: 700; margin-bottom: 1rem;">Lista de Espacios</h1>

    @if (session('success'))
        <div style="margin-top: 1rem; padding: 0.75rem; background-color: #d1fae5; color: #16a34a; border-radius: 0.375rem;">
            {{ session('success') }}
        </div>
    @endif

    <table style="margin-top: 1.5rem; width: 100%; border-collapse: collapse; border: 1px solid #d1d5db;">
        <thead>
            <tr style="background-color: #f3f4f6;">
                <th style="border: 1px solid #d1d5db; padding: 0.5rem 1rem;">Nombre</th>
                <th style="border: 1px solid #d1d5db; padding: 0.5rem 1rem;">Descripción</th>
                <th style="border: 1px solid #d1d5db; padding: 0.5rem 1rem;">Capacidad</th>
                <th style="border: 1px solid #d1d5db; padding: 0.5rem 1rem;">Precio por Hora</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($espacios as $espacio)
                <tr style="border: 1px solid #d1d5db;">
                    <td style="padding: 0.5rem 1rem;">{{ $espacio->name }}</td>
                    <td style="padding: 0.5rem 1rem;">{{ $espacio->description }}</td>
                    <td style="padding: 0.5rem 1rem;">{{ $espacio->capacity }}</td>
                    <td style="padding: 0.5rem 1rem;">{{ $espacio->precio_por_hora }} €</td>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
