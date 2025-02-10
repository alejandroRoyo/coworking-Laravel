{{-- @extends('layouts.app-master')

@section('content')
    <h1 style="text-align: center; font-size: 2.5rem; margin-bottom: 20px;">Editar Usuario</h1>

    @if ($errors->any())
        <div style="color: red; margin-bottom: 1rem;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.updateUser', $user->id) }}" method="POST" style="max-width: 500px; margin: 0 auto;">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 1rem;">
            <label for="name" style="display: block; margin-bottom: 0.5rem;">Nombre:</label>
            <input type="text" name="name" id="name" value="{{ $user->name }}" required
                   style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 5px;">
        </div>

        <div style="margin-bottom: 1rem;">
            <label for="email" style="display: block; margin-bottom: 0.5rem;">Email:</label>
            <input type="email" name="email" id="email" value="{{ $user->email }}" required
                   style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 5px;">
        </div>

        <div style="margin-bottom: 1rem;">
            <label for="rol" style="display: block; margin-bottom: 0.5rem;">Rol:</label>
            <select name="rol" id="rol" required style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 5px;">
                <option value="Usuario" {{ $user->rol === 'Usuario' ? 'selected' : '' }}>Usuario</option>
                <option value="Administrador" {{ $user->rol === 'Administrador' ? 'selected' : '' }}>Administrador</option>
            </select>
        </div>

        <button type="submit" style="width: 100%; padding: 0.75rem; background-color: #3182ce; color: white; border: none; border-radius: 5px; cursor: pointer;">
            Actualizar Usuario
        </button>
    </form>
@endsection --}}
