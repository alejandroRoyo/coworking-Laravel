@extends('layouts.app-master')

@section('content')
    <h1 style="font-size: 2rem; font-weight: 700; margin-bottom: 1.5rem;">Editar Espacio</h1>

    <form action="{{ route('espacios.update', $espacio->id) }}" method="POST" style="display: flex; flex-direction: column; gap: 1rem;">
        @csrf
        @method('PUT')
        
        <label for="name" style="font-weight: 600; color: #4a5568;">Nombre:</label>
        <input type="text" name="name" value="{{ $espacio->name }}" required style="padding: 0.5rem; border: 1px solid #e2e8f0; border-radius: 0.375rem;">

        <label for="description" style="font-weight: 600; color: #4a5568;">Descripción:</label>
        <textarea name="description" required style="padding: 0.5rem; border: 1px solid #e2e8f0; border-radius: 0.375rem;">{{ $espacio->description }}</textarea>

        <label for="capacity" style="font-weight: 600; color: #4a5568;">Capacidad:</label>
        <input type="number" name="capacity" value="{{ $espacio->capacity }}" min="1" required style="padding: 0.5rem; border: 1px solid #e2e8f0; border-radius: 0.375rem;">

        <label for="precio_por_hora" style="font-weight: 600; color: #4a5568;">Precio por Hora:</label>
        <input type="number" name="precio_por_hora" value="{{ $espacio->precio_por_hora }}" step="0.01" min="0" required style="padding: 0.5rem; border: 1px solid #e2e8f0; border-radius: 0.375rem;">

        <button type="submit" style="padding: 0.75rem; background-color: #3b82f6; color: white; border-radius: 0.375rem; border: none; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#2563eb'" onmouseout="this.style.backgroundColor='#3b82f6'">
            Actualizar
        </button>
    </form>
@endsection
