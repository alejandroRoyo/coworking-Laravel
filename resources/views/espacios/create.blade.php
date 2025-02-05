@extends('layouts.app-master')

@section('content')
    <h1>Crear Espacio</h1>

    <form action="{{ route('espacios.store') }}" method="POST">
        @csrf
        <label for="name">Nombre:</label>
        <input type="text" name="name" required>
        <br>
        
        <label for="description">Descripción:</label>
        <textarea name="description" required></textarea>
        <br>
        
        <label for="capacity">Capacidad:</label>
        <input type="number" name="capacity" min="1" required>
        <br>
        
        <label for="precio_por_hora">Precio por Hora:</label>
        <input type="number" name="precio_por_hora" step="0.01" min="0" required>
        <br>
        
        <button type="submit">Guardar</button>
    </form>
@endsection
