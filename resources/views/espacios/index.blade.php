@extends('layouts.app-master')

@section('content')
    <h1 class="text-3xl font-bold mb-4">Lista de Espacios</h1>

    <a href="{{ route('espacios.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">Crear Nuevo Espacio</a>

    @if (session('success'))
        <div class="mt-4 p-3 bg-green-200 text-green-800 rounded-md">{{ session('success') }}</div>
    @endif

    <table class="mt-6 w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 px-4 py-2">Nombre</th>
                <th class="border border-gray-300 px-4 py-2">Descripción</th>
                <th class="border border-gray-300 px-4 py-2">Capacidad</th>
                <th class="border border-gray-300 px-4 py-2">Precio por Hora</th>
                <th class="border border-gray-300 px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($espacios as $espacio)
                <tr class="border border-gray-300">
                    <td class="px-4 py-2">{{ $espacio->name }}</td>
                    <td class="px-4 py-2">{{ $espacio->description }}</td>
                    <td class="px-4 py-2">{{ $espacio->capacity }}</td>
                    <td class="px-4 py-2">${{ $espacio->precio_por_hora }}</td>
                    <td class="px-4 py-2 flex space-x-2">
                        <a href="{{ route('espacios.edit', $espacio->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded-md">Editar</a>
                        <form action="{{ route('espacios.destroy', $espacio->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-md">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
