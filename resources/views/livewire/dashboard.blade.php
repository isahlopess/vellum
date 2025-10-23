<div class="mx-auto">
    <h2 class="text-3xl font-bold text-biblioteca-800 mb-6 text-center">Bem-vindo à Biblioteca Vellum!</h2>
    <div class="bg-white rounded-xl shadow-md p-6 mb-8 border border-biblioteca-200 text-center">
        <p class="text-lg text-biblioteca-700 mb-4">Explore nosso acervo, participe de clubes do livro e encontre sua próxima grande leitura.</p>
        <p class="text-biblioteca-600">Comece navegando pelas seções abaixo ou use a barra de busca no menu para encontrar algo específico.</p>
    </div>

    <div class="flex flex-col md:flex-row justify-center gap-6 mb-12">
        <div class="bg-biblioteca-100 rounded-lg p-5 text-center shadow-sm hover:shadow-md transition-shadow md:w-72">
            <i class="bi bi-book text-4xl text-biblioteca-600 mb-3"></i>
            <h3 class="font-bold text-biblioteca-800 mb-2">Acervo Digital</h3>
            <p class="text-biblioteca-600 text-sm mb-4">Explore nossa coleção de livros digitais</p>
            <a href="{{ route('acervo') }}" class="inline-block bg-biblioteca-700 text-white px-8 py-2 rounded-lg font-medium hover:bg-biblioteca-800 transition-colors duration-300">
                Ir
            </a>
        </div>

        <div class="bg-biblioteca-100 rounded-lg p-5 text-center shadow-sm hover:shadow-md transition-shadow md:w-72">
            <i class="bi bi-people text-4xl text-biblioteca-600 mb-3"></i>
            <h3 class="font-bold text-biblioteca-800 mb-2">Clube do Livro</h3>
            <p class="text-biblioteca-600 text-sm mb-4">Participe de discussões literárias</p>
            <a href="{{ route('clube-do-livro') }}" class="inline-block bg-biblioteca-700 text-white px-8 py-2 rounded-lg font-medium hover:bg-biblioteca-800 transition-colors duration-300">
                Ir
            </a>
        </div>
    </div>

    <div class="mt-12">
        <h3 class="text-2xl font-bold text-biblioteca-800 mb-6">Destaques do Acervo</h3>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
            @foreach($livros as $livro)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    @if($livro->formatos->first()?->url)
                        <img src="{{ $livro->formatos->first()->url }}"
                             alt="Capa do livro {{ $livro->titulo }}"
                             class="w-full object-cover aspect-[2/3]">
                    @else
                        <div class="w-full bg-biblioteca-100 aspect-[2/3] flex items-center justify-center">
                            <i class="bi bi-book text-4xl text-biblioteca-400"></i>
                        </div>
                    @endif
                    <div class="p-4">
                        <h4 class="font-bold text-biblioteca-800 text-md truncate" title="{{ $livro->titulo }}">
                            {{ $livro->titulo }}
                        </h4>
                        <p class="text-biblioteca-600 text-sm truncate">
                            @foreach($livro->autores as $autor)
                                {{ $autor->nome }}@if(!$loop->last), @endif
                            @endforeach
                        </p>
                        <p class="text-biblioteca-500 text-xs mt-2">
                            {{ $livro->numero_downloads }} downloads
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
