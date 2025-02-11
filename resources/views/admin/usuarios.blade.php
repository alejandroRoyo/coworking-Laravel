{{-- @extends('layouts.app-master')

@section('content') --}}
    <div style="max-width: 1200px; margin: 0 auto; padding: 20px;">
        <h2 style="font-size: 2rem; font-weight: 700; margin-bottom: 1rem; text-align: center;">Gestión de Usuarios</h2>

        @if (session('success'))
            <div
                style="margin-bottom: 1rem; padding: 0.75rem; background-color: #d1fae5; color: #16a34a; border-radius: 0.375rem; text-align: center;">
                {{ session('success') }}
            </div>
        @endif

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <thead>
                    <tr style="background-color: #f7fafc;">
                        <th style="border: 1px solid #e2e8f0; padding: 10px;">Nombre</th>
                        <th style="border: 1px solid #e2e8f0; padding: 10px;">Email</th>
                        <th style="border: 1px solid #e2e8f0; padding: 10px;">Rol</th>
                        <th style="border: 1px solid #e2e8f0; padding: 10px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                        <tr style="background-color: #fff;">
                            <td style="border: 1px solid #e2e8f0; padding: 10px;">{{ $usuario->name }}</td>
                            <td style="border: 1px solid #e2e8f0; padding: 10px;">{{ $usuario->email }}</td>
                            <td style="border: 1px solid #e2e8f0; padding: 10px;">{{ $usuario->rol }}</td>
                            <td style="border: 1px solid #e2e8f0; padding: 10px; text-align: center;">
                                <a href="{{ route('admin.editUser', $usuario->id) }}"
                                    style="display: inline-block; padding: 5px 10px; background-color: #3182ce; color: white; text-decoration: none; border-radius: 5px; margin-right: 5px;">
                                    Editar
                                </a>
                                <form action="{{ route('admin.deleteUser', $usuario->id) }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        style="padding: 5px 10px; background-color: red; color: white; border: none; border-radius: 5px; cursor: pointer;">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Enlaces de paginación -->
        <div style="margin-top: 20px; text-align: center;">
            @if ($usuarios->currentPage() > 1)
                <a href="{{ $usuarios->previousPageUrl() }}"
                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">
                    « Anterior
                </a>
            @endif

            @if ($usuarios->hasMorePages())
                <a href="{{ $usuarios->nextPageUrl() }}"
                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">
                    Siguiente »
                </a>
            @endif
        </div>
    </div>
{{-- @endsection --}}
