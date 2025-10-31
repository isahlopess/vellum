<!DOCTYPE html>
<html lang="pt-BR">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Vellum' }}</title>

    <link rel="icon" href="{{ asset('imagens/logo_icon_branco.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('imagens/logo_icon_branco.png') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Georgia', serif; }
        .logo-text { font-family: 'Georgia', serif; text-shadow: 1px 1px 2px rgba(0,0,0,0.1); }
        .nav-link { position: relative; transition: all 0.3s ease; }
        .nav-link:after { content: ''; position: absolute; width: 0; height: 2px; bottom: -5px; left: 0; background-color: #d2a274; transition: width 0.3s ease; }
        .nav-link:hover:after, .active-nav:after { width: 100%; }
    </style>
</head>
<body class="bg-biblioteca-50 text-biblioteca-900 min-h-screen flex flex-col">
    {{ $slot }}
</body>
</html>
