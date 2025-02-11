@extends('layouts.app-master')

@section('content')
    <h1 style="text-align: center; font-size: 2rem; font-weight: bold; margin-bottom: 1.5rem;">Contacto</h1>
    
    <div style="display: flex; gap: 2rem; max-width: 1200px; margin: 0 auto; padding: 0 1rem;">
        <!-- Sección izquierda: Texto y logo -->
        <div style="flex: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
            <p style="font-size: 1.25rem; color: #333; margin-bottom: 1.5rem;">
                Si tienes alguna duda, comentario o sugerencia, puedes contactarnos y nos comunicaremos contigo lo antes posible.
            </p>
            <!-- Ajuste del tamaño de la imagen -->
            <img src="logo.png" alt="Logo" style="max-width: 250px; width: 100%; height: auto; border-radius: 8px;">
        </div>

        <!-- Sección derecha: Formulario -->
        <div style="flex: 1;">
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
    </div>
@endsection