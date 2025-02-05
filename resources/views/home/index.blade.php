@extends('layouts.app-master')

@section('content')
    <h1>Home</h1>
    @auth
        <p>Bienvenido {{ auth()->user()->name ?? 'Usuario' }}</p>
        <p>
            <a href="/logout">Cerrar sesión</a>
        </p>
    @endauth

    @guest
        <a href="/login">Iniciar sesión</a>
        <a href="/register">Registrarse</a>
    @endguest
@endsection
