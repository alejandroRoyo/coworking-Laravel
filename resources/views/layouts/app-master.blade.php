<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/avif" href="logo.png">
    <title>LaboraSpace</title>
</head>

<body style="background-color: #f7fafc; margin: 0;">
    <!-- Incluir la barra de navegación -->
    @include('layouts.partials.navbar')

    <main style="max-width: 1280px; margin: 0 auto; padding: 1.5rem;">
        @yield('content')
    </main>
</body>

</html>
