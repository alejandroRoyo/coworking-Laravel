<h2 style="font-size: 2rem; font-weight: bold; margin-bottom: 15px;">Gestión de Usuarios</h2>

<!-- Tabla de Usuarios -->
<table style="width: 100%; border-collapse: collapse; border: 1px solid #ccc;">
    <thead>
        <tr style="background: #f0f0f0;">
            <th style="border: 1px solid #ccc; padding: 10px;">Nombre</th>
            <th style="border: 1px solid #ccc; padding: 10px;">Email</th>
            <th style="border: 1px solid #ccc; padding: 10px;">Rol</th>
            <th style="border: 1px solid #ccc; padding: 10px;">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($usuarios as $usuario)
            <tr>
                <td style="border: 1px solid #ccc; padding: 10px;">{{ $usuario->name }}</td>
                <td style="border: 1px solid #ccc; padding: 10px;">{{ $usuario->email }}</td>
                <td style="border: 1px solid #ccc; padding: 10px;">
                    <form action="{{ route('admin.updateUser', $usuario->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <select name="rol" onchange="this.form.submit()" style="padding: 5px;">
                            <option value="Usuario" {{ $usuario->rol === 'Usuario' ? 'selected' : '' }}>Usuario</option>
                            <option value="Administrador" {{ $usuario->rol === 'Administrador' ? 'selected' : '' }}>Administrador</option>
                        </select>
                    </form>
                </td>
                <td style="border: 1px solid #ccc; padding: 10px;">
                    <form action="{{ route('admin.deleteUser', $usuario->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background: red; color: white; padding: 5px; border: none; cursor: pointer;">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
