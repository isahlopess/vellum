<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Vellum' }}</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        'biblioteca': {
                            50: '#fdf8f3', 100: '#f7f0e6', 200: '#eeddc9',
                            300: '#e2c5a3', 400: '#d2a274', 500: '#c08550',
                            600: '#b27046', 700: '#945a3c', 800: '#774a36',
                            900: '#613e2e',
                        }
                    }
                }
            }
        }
    </script>
    <style>
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
