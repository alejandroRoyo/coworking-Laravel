@extends('layouts.app-master')

@section('content')
    <h1 style="font-size: 1.875rem; font-weight: 700; margin-bottom: 1rem;">Lista de Espacios</h1>

    <a href="{{ route('espacios.create') }}" style="background-color: #3b82f6; color: white; padding: 0.5rem 1rem; border-radius: 0.375rem;">Crear Nuevo Espacio</a>

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
                <th style="border: 1px solid #d1d5db; padding: 0.5rem 1rem;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($espacios as $espacio)
                <tr style="border: 1px solid #d1d5db;">
                    <td style="padding: 0.5rem 1rem;">{{ $espacio->name }}</td>
                    <td style="padding: 0.5rem 1rem;">{{ $espacio->description }}</td>
                    <td style="padding: 0.5rem 1rem;">{{ $espacio->capacity }}</td>
                    <td style="padding: 0.5rem 1rem;">${{ $espacio->precio_por_hora }}</td>
                    <td style="padding: 0.5rem 1rem; display: flex; gap: 0.5rem;">
                        <a href="{{ route('espacios.edit', $espacio->id) }}" style="background-color: #f59e0b; color: white; padding: 0.25rem 0.75rem; border-radius: 0.375rem;">Editar</a>
                        <form action="{{ route('espacios.destroy', $espacio->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background-color: #ef4444; color: white; padding: 0.25rem 0.75rem; border-radius: 0.375rem;">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
