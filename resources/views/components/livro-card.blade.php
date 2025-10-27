@props(['livro'])

<li class="splide__slide">
    <a href="{{-- route('livro.show', $livro) --}}" class="block h-full group">
        <div class="bg-white rounded-lg shadow-md overflow-hidden group-hover:shadow-lg transition-shadow duration-300 h-full">

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
                    {{ $livro->autores->pluck('nome')->implode(', ') }}
                </p>

                <p class="text-biblioteca-500 text-xs mt-2">
                    {{ $livro->numero_downloads }} downloads
                </p>
            </div>
        </div>
    </a>
</li>
