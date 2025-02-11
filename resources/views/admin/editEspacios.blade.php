@extends('layouts.app-master')

@section('content')
    <h1 style="text-align: center; font-size: 2.5rem; font-weight: bold; margin-bottom: 20px;">Editar Espacio</h1>

    @if ($errors->any())
        <div style="color: red; margin-bottom: 1rem;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- El formulario utiliza la ruta de actualización del recurso 'espacios.update' -->
    <form action="{{ route('espacios.update', ['espacio' => $espacio->id]) }}" method="POST" style="max-width: 600px; margin: 0 auto;">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 1rem;">
            <label for="name" style="display: block; margin-bottom: 0.5rem;">Nombre:</label>
            <input type="text" name="name" id="name" value="{{ $espacio->name }}" required
                   style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 5px;">
        </div>

        <div style="margin-bottom: 1rem;">
            <label for="description" style="display: block; margin-bottom: 0.5rem;">Descripción:</label>
            <textarea name="description" id="description" required
                      style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 5px;">{{ $espacio->description }}</textarea>
        </div>

        <div style="margin-bottom: 1rem;">
            <label for="capacity" style="display: block; margin-bottom: 0.5rem;">Capacidad:</label>
            <input type="number" name="capacity" id="capacity" value="{{ $espacio->capacity }}" required
                   style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 5px;">
        </div>

        <div style="margin-bottom: 1rem;">
            <label for="precio_por_hora" style="display: block; margin-bottom: 0.5rem;">Precio por Hora:</label>
            <input type="number" step="0.01" name="precio_por_hora" id="precio_por_hora" value="{{ $espacio->precio_por_hora }}" required
                   style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 5px;">
        </div>

        <button type="submit" 
                style="display: block; width: 100%; padding: 0.75rem; background-color: #3182ce; color: white; border: none; border-radius: 5px; cursor: pointer; margin-bottom: 1rem;">
            Guardar Cambios
        </button>

        <a href="{{ route('admin.panel') }}" 
           style="display: block; text-align: center; color: #3182ce; text-decoration: none;">
            Volver al Panel de Control
        </a>
    </form>
@endsection
