<li class="splide__slide list-none" wire:ignore.self>
    <a class="block h-full group relative transition-all duration-300 hover:scale-105 hover:z-20">
        <div class="bg-white rounded-lg shadow-md overflow-visible group-hover:shadow-lg transition-shadow duration-300 h-full {{ $size === 'large' ? 'max-w-xs' : '' }}">

            @if(($livro['formatos'][0]['url'] ?? $livro->formatos->first()->url ?? null))
                <img src="{{ $livro['formatos'][0]['url'] ?? $livro->formatos->first()->url }}"
                     alt="Capa do livro {{ $livro['titulo'] ?? $livro->titulo }}"
                     class="w-full object-cover aspect-[2/3] rounded-t-lg">
            @else
                <div class="w-full bg-biblioteca-100 aspect-[2/3] flex items-center justify-center rounded-t-lg">
                    <i class="bi bi-book text-4xl text-biblioteca-400"></i>
                </div>
            @endif

            <div class="p-4 {{ $size === 'large' ? 'space-y-2' : '' }}">
                <h4 class="font-bold text-biblioteca-800 {{ $size === 'large' ? 'text-lg' : 'text-md' }} truncate"
                    title="{{ $livro['titulo'] ?? $livro->titulo }}">
                    {{ $livro['titulo'] ?? $livro->titulo }}
                </h4>

                <p class="text-biblioteca-600 {{ $size === 'large' ? 'text-base' : 'text-sm' }} truncate">
                    @php
                        if (is_array($livro)) {
                            $autores = collect($livro['autores'] ?? [])->pluck('nome')->implode(', ');
                        } else {
                            $autores = $livro->autores->pluck('nome')->implode(', ');
                        }
                    @endphp
                <p class="text-biblioteca-600 {{ $size === 'large' ? 'text-base' : 'text-sm' }} truncate" title="{{ $autores ?: 'Não identificado' }}">
                    {{ $autores ?: 'Não identificado' }}
                </p>

                <p class="text-biblioteca-500 {{ $size === 'large' ? 'text-sm' : 'text-xs' }} mt-2">
                    {{ $livro['numero_downloads'] ?? $livro->numero_downloads }} downloads
                </p>

                <div class="flex justify-between items-center mt-3">
                    @auth
                        <button
                            wire:click="toggleFavorite({{ $livro['id'] ?? $livro->id }})"
                            wire:loading.attr="disabled"
                            class="text-biblioteca-500 {{ $size === 'large' ? 'text-sm' : 'text-xs' }} flex items-center gap-1 hover:text-red-500 transition-colors"
                        >
                            @if($isFavorito)
                                <i class="bi bi-heart-fill text-red-500"></i>
                                <span class="{{ $size === 'large' ? 'text-sm' : 'text-xs' }}">Favorito</span>
                            @else
                                <i class="bi bi-heart"></i>
                                <span class="{{ $size === 'large' ? 'text-sm' : 'text-xs' }}">Favoritar</span>
                            @endif
                        </button>
                    @endauth

                    <button
                        wire:click="$toggle('showModal')"
                        class="bg-biblioteca-500 hover:bg-biblioteca-600 text-white px-3 py-1 rounded text-sm transition-colors"
                    >
                        Detalhes
                    </button>
                </div>
            </div>
        </div>
    </a>

    @if($showModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-lg max-w-4xl w-full max-h-[90vh] overflow-y-auto">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-biblioteca-800">Detalhes do Livro</h3>
                        <button
                            wire:click="$set('showModal', false)"
                            class="text-gray-500 hover:text-gray-700 text-2xl"
                        >
                            &times;
                        </button>
                    </div>

                    <div class="text-center py-8">
                        <p class="text-2xl">oi</p>
                        <p class="text-gray-600 mt-2">testeteste</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
</li>
