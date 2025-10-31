<x-layouts.app :title="$title">

    <header class="bg-biblioteca-800 text-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 group">
                    <div>
                        <img src="{{ asset('imagens/logo_icon_branco.png') }}" alt="Logo Vellum"
                             class="w-14 h-14 rounded-lg group-hover:scale-110 transition-transform duration-300">
                    </div>

                    <div>
                        <h1 class="logo-text text-2xl font-bold">Vellum</h1>
                        <p class="text-biblioteca-200 text-sm">O seu refúgio literário</p>
                    </div>
                </a>

                <nav class="hidden md:block">
                    <ul class="flex space-x-8 items-center">
                        <li>
                            <a href="{{ route('dashboard') }}"
                                @class([
                                    'nav-link font-medium text-biblioteca-100 hover:text-white py-2',
                                    'active-nav' => request()->routeIs('dashboard')
                                ])>
                                <i class="bi bi-house-door mr-2"></i>Tela Inicial
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('acervo') }}"
                                @class([
                                    'nav-link font-medium text-biblioteca-100 hover:text-white py-2',
                                    'active-nav' => request()->routeIs('acervo*')
                                ])>
                                <i class="bi bi-book mr-2"></i>Acervo
                            </a>
                        </li>

                        <li><a href="#" class="nav-link font-medium text-biblioteca-100 hover:text-white py-2"><i class="bi bi-search mr-2"></i>Explorar</a></li>
                        <li><a href="{{ route('minha_estante') }}" class="nav-link font-medium text-biblioteca-100 hover:text-white py-2"><i class="bi bi-bookmark mr-2"></i>Minha Estante</a></li>

                        <li class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="nav-link font-medium text-biblioteca-100 hover:text-white py-2 flex items-center space-x-2">
                                <i class="bi bi-person mr-2"></i>
                                <span>{{ auth()->user()->name }}</span>
                                <i class="bi bi-caret-down-fill ml-1"></i>
                            </button>

                            <ul x-show="open" @click.away="open = false" x-cloak class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50 py-2">
                                <li>
                                    <a href="{{ route('profile') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Perfil</a>
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Sair</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>

                <script src="//unpkg.com/alpinejs" defer></script>


                <button id="mobile-menu-button" class="md:hidden text-biblioteca-100 hover:text-white">
                    <i class="bi bi-list text-2xl"></i>
                </button>
            </div>

            <div id="mobile-menu" class="hidden md:hidden mt-4 pt-4 border-t border-biblioteca-700">
                <ul class="flex flex-col space-y-4">
                    <li>
                        <a href="{{ route('dashboard') }}"
                            @class([
                                'nav-link', 'font-medium', 'text-biblioteca-100', 'hover:text-white', 'py-2', 'block',
                                'active-nav' => request()->routeIs('dashboard')
                            ])>
                            <i class="bi bi-house-door mr-2"></i>Tela Inicial
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('acervo') }}"
                            @class([
                                'nav-link', 'font-medium', 'text-biblioteca-100', 'hover:text-white', 'py-2', 'block',
                                'active-nav' => request()->routeIs('acervo*')
                            ])>
                            <i class="bi bi-book mr-2"></i>Acervo
                        </a>
                    </li>

                    <li><a href="#" class="nav-link font-medium text-biblioteca-100 hover:text-white py-2 block"><i class="bi bi-search mr-2"></i>Explorar</a></li>
                    <li><a href="#" class="nav-link font-medium text-biblioteca-100 hover:text-white py-2 block"><i class="bi bi-bookmark mr-2"></i>Minha Estante</a></li>
                    <li><a href="#" class="nav-link font-medium text-biblioteca-100 hover:text-white py-2 block"><i class="bi bi-person mr-2"></i>Perfil</a></li>
                </ul>
            </div>
        </div>
    </header>

    <main class="flex-grow container mx-auto px-4 py-8">
        {{ $slot }}
    </main>

    <footer class="bg-biblioteca-800 text-biblioteca-200 text-center p-6 mt-auto">
        <div class="container mx-auto">
            <p>&copy; 2025 Vellum. Todos os direitos reservados.</p>
        </div>
    </footer>

    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });
    </script>

</x-layouts.app>
