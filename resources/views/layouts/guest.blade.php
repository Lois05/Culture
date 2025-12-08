<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased">

    <div class="min-h-screen flex items-center justify-center bg-cover bg-center px-4"
         style="background-image: url('{{ asset('adminlte/img/danse.jpg') }}');">

        <!-- Cadre formulaire -->
        <div class="w-full sm:max-w-md bg-white rounded-2xl shadow-xl p-6">
            {{ $slot }}
        </div>

    </div>

</body>
</html>
