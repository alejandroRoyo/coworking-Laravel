@extends('layouts.app-master')

@section('content')
    <h1>Editar Espacio</h1>

    <form action="{{ route('espacios.update', $espacio->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <label for="name">Nombre:</label>
        <input type="text" name="name" value="{{ $espacio->name }}" required>
        <br>

        <label for="description">Descripción:</label>
        <textarea name="description" required>{{ $espacio->description }}</textarea>
        <br>

        <label for="capacity">Capacidad:</label>
        <input type="number" name="capacity" value="{{ $espacio->capacity }}" min="1" required>
        <br>

        <label for="precio_por_hora">Precio por Hora:</label>
        <input type="number" name="precio_por_hora" value="{{ $espacio->precio_por_hora }}" step="0.01" min="0" required>
        <br>

        <button type="submit">Actualizar</button>
    </form>
@endsection
