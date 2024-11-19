<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME', 'PonyLink') }}</title>
    <!-- Importar los estilos de Tailwind CSS -->
    @vite('resources/css/app.css')
</head>
<body>
    {{--@auth--}}
        <header>
            @yield('navbar')
        </header>
        <main>
            @yield('content')
        </main>
      
        @yield('scripts')
    {{--@else--}}
    {{--No puedes acceder a esta página.--}}
    {{--@endauth--}}
    @vite('resources/js/app.js')
</body>
</html>