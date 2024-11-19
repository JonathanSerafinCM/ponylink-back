<!-- resources/views/navbar.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar Component</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Si usas Vite -->
</head>
<body>
    <x-navbarComponent /> <!-- Incluir el componente -->
</body>
</html>
