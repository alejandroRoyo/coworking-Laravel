<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coworking</title>
    @vite('resources/css/app.css')
</head>


<body class="bg-gray-100">
    @include('layouts.partials.navbar')

    <main class="container mx-auto p-6">
        @yield('content')
    </main>
</body>


</html>
