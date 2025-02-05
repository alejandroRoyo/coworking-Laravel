@extends('layouts.app-master')

@section('content')
    <h1>Lista de Espacios</h1>

    @if (session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <a href="{{ route('espacios.create') }}">Crear Nuevo Espacio</a>

    <table border="1">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Capacidad</th>
                <th>Precio por Hora</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($espacios as $espacio)
                <tr>
                    <td>{{ $espacio->name }}</td>
                    <td>{{ $espacio->description }}</td>
                    <td>{{ $espacio->capacity }}</td>
                    <td>${{ $espacio->precio_por_hora }}</td>
                    <td>
                        <a href="{{ route('espacios.edit', $espacio->id) }}">Editar</a>
                        <form action="{{ route('espacios.destroy', $espacio->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
