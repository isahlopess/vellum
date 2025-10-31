<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">

<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>

<div class="mx-auto">
    <h2 class="text-3xl font-bold text-biblioteca-800 mb-6 text-center">
        Bem-vindo(a), {{ explode(' ', auth()->user()->name)[0] }}!
    </h2>
    <div class="bg-white rounded-xl shadow-md p-6 mb-8 border border-biblioteca-200 text-center">
        <p class="text-lg text-biblioteca-700 mb-4">Explore nosso acervo, participe de clubes do livro e encontre sua próxima grande leitura.</p>
        <p class="text-biblioteca-600">Comece navegando pelas seções abaixo ou use a barra de busca no menu para encontrar algo específico.</p>
    </div>

    <div class="flex flex-col md:flex-row justify-center gap-6 mb-12">
        <div class="bg-biblioteca-100 rounded-lg p-5 text-center shadow-sm hover:shadow-md transition-shadow md:w-72 flex flex-col justify-between">
            <div>
                <i class="bi bi-book text-4xl text-biblioteca-600 mb-3"></i>
                <h3 class="font-bold text-biblioteca-800 mb-2">Acervo Digital</h3>
                <div class="text-biblioteca-600 text-sm mb-4">
                    <p>Explore nossa coleção de</p>
                    <p class="text-2xl font-bold text-biblioteca-700 mt-1">
                        {{ \App\Models\Livro::count() }} obras
                    </p>
                </div>
            </div>
            <a href="{{ route('acervo') }}" class="inline-block bg-biblioteca-700 text-white px-8 py-2 rounded-lg font-medium hover:bg-biblioteca-800 transition-colors duration-300">
                Ir
            </a>
        </div>

        <div class="bg-biblioteca-100 rounded-lg p-5 shadow-sm md:w-72 flex flex-col justify-between">
            <div class="text-center">
                <i class="bi bi-people text-4xl text-biblioteca-600 mb-3"></i>
                <h3 class="font-bold text-biblioteca-800 mb-2">Clube do Livro</h3>
                <div class="text-biblioteca-600 text-sm mb-4">
                    <p>*Ideia* Nosso livro deste mês:</p>
                    <p class="text-2xl font-bold text-biblioteca-700 mt-1">*Ideia* Duna</p>
                </div>
            </div>

            <a href="#" class="text-center inline-block bg-biblioteca-700 text-white px-8 py-2 rounded-lg font-medium hover:bg-biblioteca-800 transition-colors duration-300">
                Participar
            </a>
        </div>
    </div>

    <div class="mt-12">
        <h3 id="estante-title" class="text-2xl font-bold text-biblioteca-800 mb-6 flex items-center gap-2">
            <i class="bi bi-bookmark-star"></i>
            <span>Sua Estante (Favoritos)</span>
        </h3>
        <section class="splide book-carousel" id="estante-splide" data-count="{{ $meusFavoritos->count() }}" aria-labelledby="estante-title">
            <div class="splide__track pt-4">
                <ul class="splide__list">
                    @forelse($meusFavoritos as $livro)
                        <livewire:livro-card :livro="$livro" :key="'fav-'.$livro->id" />
                    @empty
                        <li class="splide__slide flex items-center justify-center">
                            <div class="text-center p-6 bg-white rounded-lg shadow-sm">
                                <i class="bi bi-bookmark-x text-4xl text-biblioteca-400 mb-3"></i>
                                <p class="text-biblioteca-600">Sua estante está vazia.</p>
                                <p class="text-sm text-biblioteca-500">Clique no <i class="bi bi-heart"></i> nos livros para favoritar.</p>
                            </div>
                        </li>
                    @endforelse
                </ul>
            </div>
        </section>
    </div>

    <div class="mt-12">
        <h3 id="downloads-title" class="text-2xl font-bold text-biblioteca-800 mb-6 flex items-center gap-2">
            <i class="bi bi-graph-up"></i>
            <span>Top Livros com + Downloads</span>
        </h3>
        <section class="splide book-carousel" aria-labelledby="downloads-title">
            <div class="splide__track pt-4">
                <ul class="splide__list">
                    @foreach($topDownloads as $livro)
                        <livewire:livro-card :livro="$livro" :key="$livro->id" />
                    @endforeach
                </ul>
            </div>
        </section>
    </div>

    <div class="mt-12" x-data="tabsManager()">
        <h3 class="text-2xl font-bold text-biblioteca-800 mb-6 flex items-center gap-2">
            <i class="bi bi-tags"></i>
            <span>Explore por Gênero</span>
        </h3>

        <div class="flex flex-wrap justify-center border-b border-biblioteca-200 mb-6">

            <button @click="openTab('aventura', 'aventura-carousel')"
                    :class="{ 'border-biblioteca-700 text-biblioteca-800': tab === 'aventura' }"
                    class="py-2 px-4 -mb-px border-b-2 font-medium text-biblioteca-600 hover:text-biblioteca-800 focus:outline-none flex items-center gap-2">
                <i class="bi bi-compass"></i>
                <span>Aventura</span>
                <span class="ml-1 bg-biblioteca-100 text-biblioteca-700 text-xs font-semibold px-2 py-0.5 rounded-full">{{ $topAventuras->count() }}</span>
            </button>

            <button @click="openTab('romance', 'romance-carousel')"
                    :class="{ 'border-biblioteca-700 text-biblioteca-800': tab === 'romance' }"
                    class="py-2 px-4 -mb-px border-b-2 font-medium text-biblioteca-600 hover:text-biblioteca-800 focus:outline-none flex items-center gap-2">
                <i class="bi bi-heart"></i>
                <span>Romance</span>
                <span class="ml-1 bg-biblioteca-100 text-biblioteca-700 text-xs font-semibold px-2 py-0.5 rounded-full">{{ $topRomances->count() }}</span>
            </button>

            <button @click="openTab('fantasia', 'fantasia-carousel')"
                    :class="{ 'border-biblioteca-700 text-biblioteca-800': tab === 'fantasia' }"
                    class="py-2 px-4 -mb-px border-b-2 font-medium text-biblioteca-600 hover:text-biblioteca-800 focus:outline-none flex items-center gap-2">
                <i class="bi bi-magic"></i>
                <span>Fantasia</span>
                <span class="ml-1 bg-biblioteca-100 text-biblioteca-700 text-xs font-semibold px-2 py-0.5 rounded-full">{{ $topFantasias->count() }}</span>
            </button>

            <button @click="openTab('horror', 'horror-carousel')"
                    :class="{ 'border-biblioteca-700 text-biblioteca-800': tab === 'horror' }"
                    class="py-2 px-4 -mb-px border-b-2 font-medium text-biblioteca-600 hover:text-biblioteca-800 focus:outline-none flex items-center gap-2">
                <i class="bi bi-mask"></i>
                <span>Horror</span>
                <span class="ml-1 bg-biblioteca-100 text-biblioteca-700 text-xs font-semibold px-2 py-0.5 rounded-full">{{ $topHorror->count() }}</span>
            </button>

            <button @click="openTab('ficcao', 'ficcao-carousel')"
                    :class="{ 'border-biblioteca-700 text-biblioteca-800': tab === 'ficcao' }"
                    class="py-2 px-4 -mb-px border-b-2 font-medium text-biblioteca-600 hover:text-biblioteca-800 focus:outline-none flex items-center gap-2">
                <i class="bi bi-robot"></i>
                <span>Ficção</span>
                <span class="ml-1 bg-biblioteca-100 text-biblioteca-700 text-xs font-semibold px-2 py-0.5 rounded-full">{{ $topFiccao->count() }}</span>
            </button>

            <button @click="openTab('historia', 'historia-carousel')"
                    :class="{ 'border-biblioteca-700 text-biblioteca-800': tab === 'historia' }"
                    class="py-2 px-4 -mb-px border-b-2 font-medium text-biblioteca-600 hover:text-biblioteca-800 focus:outline-none flex items-center gap-2">
                <i class="bi bi-book-half"></i>
                <span>História</span>
                <span class="ml-1 bg-biblioteca-100 text-biblioteca-700 text-xs font-semibold px-2 py-0.5 rounded-full">{{ $topHistoria->count() }}</span>
            </button>

        </div>

        <div x-show="tab === 'aventura'" x-cloak>
            <section class="splide" id="aventura-carousel" aria-label="Aventura">
                <div class="splide__track pt-4"><ul class="splide__list">
                        @foreach($topAventuras as $livro) <livewire:livro-card :livro="$livro" :key="'av-'.$livro->id" /> @endforeach
                    </ul></div>
            </section>
        </div>
        <div x-show="tab === 'romance'" x-cloak>
            <section class="splide" id="romance-carousel" aria-label="Romance">
                <div class="splide__track pt-4"><ul class="splide__list">
                        @foreach($topRomances as $livro) <livewire:livro-card :livro="$livro" :key="'ro-'.$livro->id" /> @endforeach
                    </ul></div>
            </section>
        </div>
        <div x-show="tab === 'fantasia'" x-cloak>
            <section class="splide" id="fantasia-carousel" aria-label="Fantasia">
                <div class="splide__track pt-4"><ul class="splide__list">
                        @foreach($topFantasias as $livro) <livewire:livro-card :livro="$livro" :key="'fa-'.$livro->id" /> @endforeach
                    </ul></div>
            </section>
        </div>
        <div x-show="tab === 'horror'" x-cloak>
            <section class="splide" id="horror-carousel" aria-label="Horror">
                <div class="splide__track pt-4"><ul class="splide__list">
                        @foreach($topHorror as $livro) <livewire:livro-card :livro="$livro" :key="'ho-'.$livro->id" /> @endforeach
                    </ul></div>
            </section>
        </div>
        <div x-show="tab === 'ficcao'" x-cloak>
            <section class="splide" id="ficcao-carousel" aria-label="Ficção">
                <div class="splide__track pt-4"><ul class="splide__list">
                        @foreach($topFiccao as $livro) <livewire:livro-card :livro="$livro" :key="'fi-'.$livro->id" /> @endforeach
                    </ul></div>
            </section>
        </div>
        <div x-show="tab === 'historia'" x-cloak>
            <section class="splide" id="historia-carousel" aria-label="História">
                <div class="splide__track pt-4"><ul class="splide__list">
                        @foreach($topHistoria as $livro) <livewire:livro-card :livro="$livro" :key="'hi-'.$livro->id" /> @endforeach
                    </ul></div>
            </section>
        </div>
    </div>
</div>

<script>
    // Opções padrão para todos os carrosséis
    var splideOptions = {
        type: 'loop',
        perPage: 7,
        gap: '1.5rem',
        pagination: false,
        arrows: 'true',
        breakpoints: {
            1024: { perPage: 5 },
            768: { perPage: 4 },
            640: { perPage: 3 },
        }
    };

    // Rastreador para carrosséis de abas (evita montar várias vezes)
    var mountedSplides = {};

    // 1. Inicializa os carrosséis FORA das abas
    document.addEventListener('DOMContentLoaded', function () {
        var standardCarousels = document.querySelectorAll('.book-carousel');

        for (var i = 0; i < standardCarousels.length; i++) {
            var el = standardCarousels[i];
            var options = { ...splideOptions }; // Copia opções padrão

            // *** INÍCIO DA NOVA LÓGICA PARA FAVORITOS ***
            // Verifica se este é o carrossel de favoritos
            if (el.id === 'estante-splide') {
                var favCount = parseInt(el.getAttribute('data-count')) || 0;
                var perPage = options.perPage || 7;

                // Se houver menos itens que 'perPage' (ou 0), desliga o loop
                if (favCount <= perPage) {
                    options.type = 'slide';
                    options.pagination = false;

                    if (favCount === 0) {
                        options.perPage = 1;
                        options.arrows = false;
                        options.drag = false;
                        el.querySelector('.splide__list').classList.add('flex', 'justify-center');
                    } else {
                        options.perPage = favCount;
                        options.arrows = favCount > 1;
                        options.drag = true;
                    }
                }
            }

            new Splide(el, options).mount();
        }
    });

    function tabsManager() {
        return {
            tab: 'aventura',
            init() {
                this.mountSplide('aventura-carousel');
            },
            openTab(tabName, carouselId) {
                this.tab = tabName;
                setTimeout(() => this.mountSplide(carouselId), 10);
            },
            mountSplide(carouselId) {
                if (mountedSplides[carouselId]) {
                    return;
                }
                var element = document.getElementById(carouselId);
                if (element) {
                    var splide = new Splide(element, splideOptions);
                    splide.mount();
                    mountedSplides[carouselId] = true;
                }
            }
        }
    }
</script>
