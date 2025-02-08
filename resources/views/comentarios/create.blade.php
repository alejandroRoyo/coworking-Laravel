@extends('layouts.app-master')

@section('content')
<style>
    p.clasificacion {
        position: relative;
        overflow: hidden;
        display: inline-block;
        font-size: 30px;
    }

    p.clasificacion input {
        position: absolute;
        top: -100px;
    }

    p.clasificacion label {
        float: right;
        color: #333;
    }

    p.clasificacion label:hover,
    p.clasificacion label:hover~label,
    p.clasificacion input:checked~label {
        color: #dd4;
    }
</style>
<h1 style="font-size: 2rem; font-weight: bold; margin-bottom: 1.5rem;">Añadir Comentario</h1>

@if ($errors->any())
    <div style="color: red; margin-bottom: 1rem;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('comentarios.store') }}" method="POST">
    @csrf

    <div style="margin-bottom: 1rem;">
        <label for="nombre" style="display: block; margin-bottom: 0.5rem;">Nombre (opcional):</label>
        <input type="text" name="nombre" id="nombre"
            style="padding: 0.5rem; width: 100%; border: 1px solid #ccc; border-radius: 5px;">
    </div>

    <div style="margin-bottom: 1rem;">
        <label for="comentario" style="display: block; margin-bottom: 0.5rem;">Comentario:</label>
        <textarea name="comentario" id="comentario" required
            style="padding: 0.5rem; width: 100%; border: 1px solid #ccc; border-radius: 5px;" rows="5"></textarea>
    </div>

    <p class="clasificacion">
        <input id="radio1" type="radio" name="estrellas" value="5">
        <label for="radio1">★</label>
        <input id="radio2" type="radio" name="estrellas" value="4">
        <label for="radio2">★</label>
        <input id="radio3" type="radio" name="estrellas" value="3">
        <label for="radio3">★</label>
        <input id="radio4" type="radio" name="estrellas" value="2">
        <label for="radio4">★</label>
        <input id="radio5" type="radio" name="estrellas" value="1">
        <label for="radio5">★</label>
    </p>
    <br>
    <button type="submit"
        style="padding: 0.75rem; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">
        Enviar Comentario
    </button>
</form>
@endsection