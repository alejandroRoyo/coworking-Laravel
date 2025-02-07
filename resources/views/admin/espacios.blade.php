@extends('layouts.app-master')

@section('content')
    <h1 style="text-align: center; font-size: 2.5rem; font-weight: bold; margin-bottom: 20px;">
        Panel de Control
    </h1>

    <!-- Navegación entre pestañas -->
    <div style="display: flex; justify-content: center; gap: 20px; margin-bottom: 20px;">
        <button onclick="showTab('usuarios')" style="padding: 10px 20px; border: none; background: #007bff; color: white; cursor: pointer;">Usuarios</button>
        <button onclick="showTab('espacios')" style="padding: 10px 20px; border: none; background: #28a745; color: white; cursor: pointer;">Espacios</button>
        <button onclick="showTab('reservas')" style="padding: 10px 20px; border: none; background: #ff9800; color: white; cursor: pointer;">Reservas</button>
    </div>

    <!-- Sección de Usuarios -->
    <div id="usuarios" class="tab" style="display: block;">
        @include('admin.usuarios')
    </div>

    <!-- Sección de Espacios -->
    <div id="espacios" class="tab" style="display: none;">
        {{-- @include('admin.espacios') --}}
    </div>

    <!-- Sección de Reservas -->
    <div id="reservas" class="tab" style="display: none;">
        {{-- @include('admin.reservas') --}}
    </div>

    <script>
        function showTab(tabId) {
            document.querySelectorAll('.tab').forEach(tab => tab.style.display = 'none');
            document.getElementById(tabId).style.display = 'block';
        }
    </script>
@endsection
