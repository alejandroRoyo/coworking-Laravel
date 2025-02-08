@extends('layouts.app-master')

@section('content')
    <h1 style="text-align: center; font-size: 2rem; font-weight: bold; margin-bottom: 1.5rem;">Contacto</h1>
    <div style="max-width: 600px; margin: 0 auto;">
        <form action="{{ route('contact.send') }}" method="POST">
            @csrf
            <div style="margin-bottom: 1rem;">
                <label for="name" style="display: block; margin-bottom: 0.5rem;">Nombre:</label>
                <input type="text" name="name" id="name" required
                       style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 5px;">
            </div>
            <div style="margin-bottom: 1rem;">
                <label for="email" style="display: block; margin-bottom: 0.5rem;">Correo Electrónico:</label>
                <input type="email" name="email" id="email" required
                       style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 5px;">
            </div>
            <div style="margin-bottom: 1rem;">
                <label for="subject" style="display: block; margin-bottom: 0.5rem;">Asunto:</label>
                <input type="text" name="subject" id="subject" required
                       style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 5px;">
            </div>
            <div style="margin-bottom: 1rem;">
                <label for="message" style="display: block; margin-bottom: 0.5rem;">Mensaje:</label>
                <textarea name="message" id="message" rows="5" required
                          style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 5px;"></textarea>
            </div>
            <button type="submit" 
                    style="width: 100%; padding: 0.75rem; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">
                Enviar Mensaje
            </button>
        </form>
    </div>
@endsection
