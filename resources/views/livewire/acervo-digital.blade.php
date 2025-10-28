<div class="mx-auto">

    <div class="mb-10 text-center md:text-left">
        <h2 class="text-4xl font-bold text-biblioteca-800 mb-2">Acervo Digital</h2>
        <p class="text-lg text-biblioteca-600">Explore, pesquise e filtre nossa coleção completa de obras.</p>
    </div>

    <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-8">

        <div class="relative w-full md:w-2/3 lg:w-1/2">
            <input type="search"
                   wire:model.live.debounce.300ms="busca"
                   placeholder="Pesquisar por título ou autor..."
                   class="w-full pl-10 pr-4 py-3 rounded-lg border border-biblioteca-300 focus:outline-none focus:ring-2 focus:ring-biblioteca-500">
            <i class="bi bi-search text-biblioteca-500 absolute left-3 top-1/2 -translate-y-1/2"></i>
        </div>

        <div class="flex-shrink-0 w-full md:w-auto">
            <select wire:model.live="ordenar" class="w-full md:w-auto p-3 rounded-lg border border-biblioteca-300 focus:outline-none focus:ring-2 focus:ring-biblioteca-500">
                <option value="populares">Mais Populares</option>
                <option value="recentes">Adicionados Recentemente</option>
                <option value="az">Ordem Alfabética (A-Z)</option>
                <option value="za">Ordem Alfabética (Z-A)</option>
            </select>
        </div>
    </div>

    <div class="flex flex-col md:flex-row gap-8 lg:gap-12">

        <aside class="w-full md:w-1/4 lg:w-1/5">
            <div class="sticky top-10">
                <h3 class="text-xl font-bold text-biblioteca-800 mb-5">Filtros</h3>
                <div class="space-y-6">

                    <div>
                        <h4 class="font-semibold text-biblioteca-700 mb-3">Gênero</h4>
                        <div class="space-y-2 max-h-60 overflow-y-auto pr-2">
                            @forelse($generos as $genero)
                                <label class="flex items-center space-x-2 text-biblioteca-600 hover:text-biblioteca-800 cursor-pointer">
                                    <input type="checkbox"
                                           wire:model.live="generosSelecionados"
                                           value="{{ $genero['valor'] }}"
                                           class="rounded text-biblioteca-700 focus:ring-biblioteca-500">
                                    <span>{{ $genero['nome'] }} ({{ $genero['livros_count'] }})</span>
                                </label>
                            @empty
                                <p class="text-sm text-biblioteca-500">Nenhum gênero encontrado.</p>
                            @endforelse
                        </div>
                    </div>

                    <div>
                        <h4 class="font-semibold text-biblioteca-700 mb-3">Autor</h4>
                        <div class="space-y-2 max-h-60 overflow-y-auto pr-2">
                            @forelse($autores as $autor)
                                <label class="flex items-center space-x-2 text-biblioteca-600 hover:text-biblioteca-800 cursor-pointer">
                                    <input type="checkbox"
                                           wire:model.live="autoresSelecionados"
                                           value="{{ $autor->id }}"
                                           class="rounded text-biblioteca-700 focus:ring-biblioteca-500">
                                    <span>{{ $autor->nome }}</span>
                                </label>
                            @empty
                                <p class="text-sm text-biblioteca-500">Nenhum autor encontrado.</p>
                            @endforelse
                        </div>
                    </div>

                    @if(!empty($generosSelecionados) || !empty($autoresSelecionados) || !empty($busca))
                        <button wire:click="limparFiltros"
                                class="w-full bg-biblioteca-200 text-biblioteca-700 px-4 py-2 rounded-lg font-medium hover:bg-biblioteca-300 transition-colors duration-300">
                            Limpar Filtros
                        </button>
                    @endif
                </div>
            </div>
        </aside>

        <main class="w-full md:w-3/4 lg:w-4/5">
            <div wire:loading class="w-full mb-6">
                <div class="flex items-center justify-center gap-3 bg-biblioteca-100 p-4 rounded-lg">
                    <i class="bi bi-arrow-clockwise text-2xl text-biblioteca-700 animate-spin"></i>
                    <span class="font-medium text-biblioteca-700">Atualizando acervo...</span>
                </div>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                @forelse($livros as $livro)
                    <a href="#" class="block group h-full">
                        <div class="bg-white rounded-lg shadow-md overflow-hidden transition-shadow duration-300 h-full flex flex-col group-hover:shadow-xl">
                            <div class="overflow-hidden">
                                @if($livro->formatos->first()?->url)
                                    <img src="{{ $livro->formatos->first()->url }}"
                                         alt="Capa do livro {{ $livro->titulo }}"
                                         class="w-full object-cover aspect-[2/3] transition-transform duration-300 group-hover:scale-105">
                                @else
                                    <div class="w-full bg-biblioteca-100 aspect-[2/3] flex items-center justify-center transition-transform duration-300 group-hover:scale-105">
                                        <i class="bi bi-book text-4xl text-biblioteca-400"></i>
                                    </div>
                                @endif
                            </div>

                            <div class="p-4 flex-grow">
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
                    </a>
                @empty
                    <div class="col-span-full text-center py-12 bg-white border border-biblioteca-200 rounded-lg shadow-sm">
                        <i class="bi bi-search-heart text-5xl text-biblioteca-400 mb-4"></i>
                        <h4 class="text-xl font-bold text-biblioteca-700">Nenhum livro encontrado</h4>
                        <p class="text-biblioteca-600">Tente ajustar seus termos de busca ou filtros.</p>
                    </div>
                @endforelse

            </div>

            <div class="mt-12">
                {{ $livros->links() }}
            </div>

        </main>
    </div>
</div>
