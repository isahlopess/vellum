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

    <div class="mt-12">
        <h3 id="aventura-title" class="text-2xl font-bold text-biblioteca-800 mb-6 flex items-center gap-2">
            <i class="bi bi-compass"></i>
            <span>Melhores do genêro: Aventura</span>
        </h3>
        <section class="splide book-carousel" aria-labelledby="aventura-title">
            <div class="splide__track pt-4">
                <ul class="splide__list">
                    @foreach($topAventuras as $livro)
                        <livewire:livro-card :livro="$livro" :key="$livro->id" />
                    @endforeach
                </ul>
            </div>
        </section>
    </div>


    <div class="mt-12">
        <h3 id="romance-title" class="text-2xl font-bold text-biblioteca-800 mb-6 flex items-center gap-2">
            <i class="bi bi-heart"></i>
            <span>Melhores do genêro: Romance</span>
        </h3>
        <section class="splide book-carousel" aria-labelledby="romance-title">
            <div class="splide__track pt-4">
                <ul class="splide__list">
                    @foreach($topRomances as $livro)
                        <livewire:livro-card :livro="$livro" :key="$livro->id" />
                    @endforeach
                </ul>
            </div>
        </section>
    </div>

    <div class="mt-12">
        <h3 id="fantasia-title" class="text-2xl font-bold text-biblioteca-800 mb-6 flex items-center gap-2">
            <i class="bi bi-magic"></i>
            <span>Melhores do genêro: Fantasia</span>
        </h3>
        <section class="splide book-carousel" aria-labelledby="fantasia-title">
            <div class="splide__track pt-4">
                <ul class="splide__list">
                    @foreach($topFantasias as $livro)
                        <livewire:livro-card :livro="$livro" :key="$livro->id" />
                    @endforeach
                </ul>
            </div>
        </section>
    </div>

    <div class="mt-12">
        <h3 id="horror-title" class="text-2xl font-bold text-biblioteca-800 mb-6 flex items-center gap-2">
            <i class="bi bi-mask"></i>
            <span>Melhores do genêro: Horror</span>
        </h3>
        <section class="splide book-carousel" aria-labelledby="horror-title">
            <div class="splide__track pt-4">
                <ul class="splide__list">
                    @foreach($topHorror as $livro)
                        <livewire:livro-card :livro="$livro" :key="$livro->id" />
                    @endforeach
                </ul>
            </div>
        </section>
    </div>

    <div class="mt-12">
        <h3 id="ficcao-title" class="text-2xl font-bold text-biblioteca-800 mb-6 flex items-center gap-2">
            <i class="bi bi-robot"></i>
            <span>Melhores do genêro: Ficção</span>
        </h3>
        <section class="splide book-carousel" aria-labelledby="ficcao-title">
            <div class="splide__track pt-4">
                <ul class="splide__list">
                    @foreach($topFiccao as $livro)
                        <livewire:livro-card :livro="$livro" :key="$livro->id" />
                    @endforeach
                </ul>
            </div>
        </section>
    </div>

    <div class="mt-12">
        <h3 id="historia-title" class="text-2xl font-bold text-biblioteca-800 mb-6 flex items-center gap-2">
            <i class="bi bi-book-half"></i>
            <span>Melhores do genêro: História</span>
        </h3>
        <section class="splide book-carousel" aria-labelledby="historia-title">
            <div class="splide__track pt-4">
                <ul class="splide__list">
                    @foreach($topHistoria as $livro)
                        <livewire:livro-card
                            :livro="$livro"
                            :key="$livro->id" />
                    @endforeach
                </ul>
            </div>
        </section>
    </div>
</div>

<script>
    document.addEventListener( 'DOMContentLoaded', function () {
        var carousels = document.querySelectorAll('.book-carousel');

        for (var i = 0; i < carousels.length; i++) {
            new Splide( carousels[i], {

                type: 'loop',

                perPage: 7,

                gap: '1.5rem',
                pagination: false,
                arrows: 'true',

                breakpoints: {
                    1024: { // Abaixo de 1024px (md)
                        perPage: 5,
                    },
                    768: { // Abaixo de 768px (sm)
                        perPage: 4,
                    },
                    640: { // Abaixo de 640px (mobile)
                        perPage: 3,
                    },
                }
            } ).mount();
        }
    } );
</script>
