<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="flex flex-col min-h-screen">
       <header class="bg-blue-800 text-white">
            @include('partials.menu')
       </header>
       <main class="flex-grow">
            @yield('content')
       </main>
       <footer class="pl-10 text-center bg-blue-800 text-white py-4">
            Aplicación desarrollada por 🦫 en 2026
       </footer>
    </body>
</html>
