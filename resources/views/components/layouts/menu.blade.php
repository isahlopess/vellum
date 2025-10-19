<x-layouts.app :title="$title">

    <header class="bg-biblioteca-800 text-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <a href="#" class="flex items-center space-x-3 group">
                    <div class="bg-biblioteca-600 p-2 rounded-lg group-hover:bg-biblioteca-500 transition-colors">
                        <i class="bi bi-book-half text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="logo-text text-2xl font-bold">Biblioteca Virtual</h1>
                        <p class="text-biblioteca-200 text-sm">O seu refúgio literário</p>
                    </div>
                </a>

                <nav class="hidden md:block">
                    <ul class="flex space-x-8">
                        <li><a href="#" class="nav-link active-nav font-medium text-biblioteca-100 hover:text-white py-2"><i class="bi bi-house-door mr-2"></i>Tela Inicial</a></li>
                        <li><a href="#" class="nav-link font-medium text-biblioteca-100 hover:text-white py-2"><i class="bi bi-search mr-2"></i>Explorar</a></li>
                        <li><a href="#" class="nav-link font-medium text-biblioteca-100 hover:text-white py-2"><i class="bi bi-bookmark mr-2"></i>Minha Estante</a></li>
                        <li><a href="#" class="nav-link font-medium text-biblioteca-100 hover:text-white py-2"><i class="bi bi-person mr-2"></i>Perfil</a></li>
                    </ul>
                </nav>

                <button id="mobile-menu-button" class="md:hidden text-biblioteca-100 hover:text-white">
                    <i class="bi bi-list text-2xl"></i>
                </button>
            </div>

            <div id="mobile-menu" class="hidden md:hidden mt-4 pt-4 border-t border-biblioteca-700">
                <ul class="flex flex-col space-y-4">
                    <li><a href="#" class="nav-link active-nav font-medium text-biblioteca-100 hover:text-white py-2 block"><i class="bi bi-house-door mr-2"></i>Tela Inicial</a></li>
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
            <p>&copy; 2023 Biblioteca Virtual. Todos os direitos reservados.</p>
            <p class="mt-2 text-sm">Desenvolvido com <i class="bi bi-heart-fill text-red-400"></i> para amantes da leitura</p>
        </div>
    </footer>

    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });
    </script>

</x-layouts.app>