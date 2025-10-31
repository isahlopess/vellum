<li class="splide__slide" wire:ignore.self>
    <a class="block h-full group">
        <div class="bg-white rounded-lg shadow-md overflow-hidden group-hover:shadow-lg transition-shadow duration-300 h-full {{ $size === 'large' ? 'max-w-xs' : '' }}">

            @if(($livro['formatos'][0]['url'] ?? $livro->formatos->first()->url ?? null))
                <img src="{{ $livro['formatos'][0]['url'] ?? $livro->formatos->first()->url }}"
                     alt="Capa do livro {{ $livro['titulo'] ?? $livro->titulo }}"
                     class="w-full object-cover aspect-[2/3] {{ $size === 'large' ? 'group-hover:scale-105 transition-transform duration-300' : '' }}">
            @else
                <div class="w-full bg-biblioteca-100 aspect-[2/3] flex items-center justify-center {{ $size === 'large' ? 'group-hover:scale-105 transition-transform duration-300' : '' }}">
                    <i class="bi bi-book text-4xl text-biblioteca-400"></i>
                </div>
            @endif

            <div class="p-4 {{ $size === 'large' ? 'space-y-2' : '' }}">
                <h4 class="font-bold text-biblioteca-800 {{ $size === 'large' ? 'text-lg' : 'text-md' }} truncate"
                    title="{{ $livro['titulo'] ?? $livro->titulo }}">
                    {{ $livro['titulo'] ?? $livro->titulo }}
                </h4>

                <p class="text-biblioteca-600 {{ $size === 'large' ? 'text-base' : 'text-sm' }} truncate">
                    @if(is_array($livro))
                        {{ collect($livro['autores'] ?? [])->pluck('nome')->implode(', ') }}
                    @else
                        {{ $livro->autores->pluck('nome')->implode(', ') }}
                    @endif
                </p>

                <p class="text-biblioteca-500 {{ $size === 'large' ? 'text-sm' : 'text-xs' }} mt-2">
                    {{ $livro['numero_downloads'] ?? $livro->numero_downloads }} downloads
                </p>

                @auth
                    <button
                        wire:click="toggleFavorite({{ $livro['id'] ?? $livro->id }})"
                        wire:loading.attr="disabled"
                        class="text-biblioteca-500 {{ $size === 'large' ? 'text-sm' : 'text-xs' }} mt-2 flex items-center gap-1 hover:text-red-500 transition-colors"
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
            </div>
        </div>
    </a>
</li>
