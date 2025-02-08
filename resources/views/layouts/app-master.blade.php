<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaboraSpace</title>
    <!-- Aquí puedes incluir tu archivo CSS tradicional -->
    <link rel="stylesheet" href="path_to_your_css/app.css">
</head>

<body style="background-color: #f7fafc; margin: 0;">
    <!-- Incluir la barra de navegación -->
    @include('layouts.partials.navbar')

    <main style="max-width: 1280px; margin: 0 auto; padding: 1.5rem;">
        @yield('content')
    </main>
</body>

</html>
