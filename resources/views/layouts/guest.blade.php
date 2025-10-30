<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Vellum') }}</title>

    <link rel="icon" href="{{ asset('imagens/logo_icon_branco.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('imagens/logo_icon_branco.png') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased">

<div class="relative min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8 bg-cover bg-no-repeat"
     style="background-image: url(https://images.unsplash.com/photo-1507842217343-583bb7270b66?auto=format&fit=crop&w=1950&q=80);">

    <div class="absolute bg-black opacity-60 inset-0 z-0"></div>

    <div class="max-w-md w-full p-8 md:p-10 bg-white rounded-xl shadow-2xl z-10">
        {{ $slot }}
    </div>
</div>
</body>
</html>
