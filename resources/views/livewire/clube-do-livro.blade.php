<div class="mx-auto">

    <div class="mb-10">
        <h2 class="text-4xl font-bold text-biblioteca-800 mb-2">Clube do Livro Vellum</h2>
        <p class="text-lg text-biblioteca-600">Discuta, descubra e conecte-se com outros leitores.</p>
    </div>

    <div class="mb-8 p-6 bg-white rounded-xl shadow-md border border-biblioteca-200 flex flex-col md:flex-row justify-between items-center gap-4">
        @if (auth()->user()->is_membro_clube)
            <div>
                <h3 class="text-xl font-bold text-biblioteca-800">Você é membro!</h3>
                <p class="text-biblioteca-600">Bem-vindo(a) de volta. Participe da discussão abaixo.</p>
            </div>
            <button wire:click="sairClube"
                    wire:loading.attr="disabled"
                    class="inline-flex items-center bg-red-100 text-red-700 px-6 py-2 rounded-lg font-medium hover:bg-red-200 transition-colors duration-300">
                <span wire:loading.remove wire:target="sairClube">Sair do Clube</span>
                <span wire:loading wire:target="sairClube" class="flex items-center">
                    <span class="border-t-transparent border-solid animate-spin rounded-full border-red-500 border-2 h-4 w-4 mr-2"></span>
                    Saindo...
                </span>
            </button>
        @else
            <div>
                <h3 class="text-xl font-bold text-biblioteca-800">Junte-se ao Clube!</h3>
                <p class="text-biblioteca-600">Torne-se membro para participar das discussões e receber notificações.</p>
            </div>
            <button wire:click="entrarClube"
                    wire:loading.attr="disabled"
                    class="inline-flex items-center bg-biblioteca-700 text-white px-6 py-2 rounded-lg font-medium hover:bg-biblioteca-800 transition-colors duration-300">
                <span wire:loading.remove wire:target="entrarClube">Entrar no Clube</span>
                <span wire:loading wire:target="entrarClube" class="flex items-center">
                    <span class="border-t-transparent border-solid animate-spin rounded-full border-white border-2 h-4 w-4 mr-2"></span>
                    Entrando...
                </span>
            </button>
        @endif
    </div>

    <div class="flex flex-col md:flex-row gap-8 lg:gap-12">

        <main class="w-full md:w-3/4 lg:w-4/5 space-y-12">

            @if ($sessaoAtiva)
                <section class="bg-white rounded-xl shadow-md border border-biblioteca-200 overflow-hidden">
                    <div class="flex flex-col md:flex-row">
                        <div class="md:w-1/3">
                            <img src="{{ $sessaoAtiva->livro->formatos->first()->url ?? 'https://placehold.co/400x600/c08550/FFFFFF?text=Capa' }}"
                                 alt="Capa do livro {{ $sessaoAtiva->livro->titulo }}"
                                 class="w-full h-full object-cover">
                        </div>

                        <div class="md:w-2/3 p-6 md:p-8 flex flex-col">
                            <div>
                                <span class="inline-block bg-biblioteca-100 text-biblioteca-700 text-sm font-semibold px-3 py-1 rounded-full mb-4">
                                    Livro do Mês
                                </span>
                                <h3 class="text-4xl font-bold text-biblioteca-800">{{ $sessaoAtiva->livro->titulo }}</h3>
                                <p class="text-xl text-biblioteca-600 mt-1 mb-4">
                                    por {{ $sessaoAtiva->livro->autores->pluck('nome')->implode(', ') }}
                                </p>
                                <p class="text-biblioteca-700 leading-relaxed mb-6">
                                    {{ $sessaoAtiva->livro->sinopse ?? 'Uma breve descrição do livro...' }}
                                </p>
                            </div>

                            <div class="mt-auto pt-6 border-t border-biblioteca-200 space-y-4">
                                <div>
                                    <h4 class="font-semibold text-biblioteca-800 flex items-center gap-2">
                                        <i class="bi bi-calendar-event text-biblioteca-700"></i>
                                        Próxima Discussão ao Vivo
                                    </h4>
                                    <p class="text-biblioteca-600 ml-6">{{ \Carbon\Carbon::parse($sessaoAtiva->data_discussao)->format('d \de F, H:i') }}</p>
                                </div>

                                <div class="flex flex-col sm:flex-row gap-4">
                                    <a href="{{ $sessaoAtiva->livro->formatos->first()->url_download ?? '#' }}" class="w-full sm:w-auto text-center inline-block bg-biblioteca-700 text-white px-8 py-3 rounded-lg font-medium hover:bg-biblioteca-800 transition-colors duration-300">
                                        <i class="bi bi-download mr-2"></i>
                                        Baixar E-book
                                    </a>
                                    <a href="#discussao" class="w-full sm:w-auto text-center inline-block bg-biblioteca-200 text-biblioteca-700 px-8 py-3 rounded-lg font-medium hover:bg-biblioteca-300 transition-colors duration-300">
                                        <i class="bi bi-chat-dots mr-2"></i>
                                        Ir para Discussão
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @else
                <section class="bg-white rounded-xl shadow-md border border-biblioteca-200 p-8 text-center">
                    <i class="bi bi-book-half text-6xl text-biblioteca-400 mb-4"></i>
                    <h3 class="text-2xl font-bold text-biblioteca-800">Nenhum livro selecionado para este mês.</h3>
                    <p class="text-biblioteca-600 mt-2">Volte em breve para ver nossa próxima leitura!</p>
                </section>
            @endif

            <section id="discussao" class="bg-white rounded-xl shadow-md border border-biblioteca-200 p-6 md:p-8">
                <h3 class="text-3xl font-bold text-biblioteca-800 mb-6 flex items-center gap-3">
                    <i class="bi bi-chat-left-text"></i>
                    Fórum de Discussão
                </h3>

                @if(auth()->user()->is_membro_clube)
                    <form wire:submit="adicionarComentario" class="flex items-start gap-4 mb-8">
                        <span class="block h-12 w-12 rounded-full bg-biblioteca-100 overflow-hidden">
                            @if (Auth::user()->profile_photo_path)
                                <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" alt="Sua foto" class="h-full w-full object-cover">
                            @else
                                <div class="h-full w-full flex items-center justify-center bg-biblioteca-200 text-biblioteca-600 font-semibold text-lg">
                                    {{ \App\Services\CommumFunctions::getIniciais(Auth::user()->name) }}
                                </div>
                            @endif
                        </span>
                        <div class="flex-1">
                            <textarea wire:model="novoComentario" rows="3" placeholder="O que você achou do livro, {{ explode(' ', auth()->user()->name)[0] }}?" class="w-full p-3 rounded-lg border border-biblioteca-300 focus:outline-none focus:ring-2 focus:ring-biblioteca-500"></textarea>
                            @error('novoComentario') <span class="text-sm text-red-600">{{ $message }}</span> @enderror

                            @if (session('comentario_status'))
                                <span class="text-sm text-green-600">{{ session('comentario_status') }}</span>
                            @endif

                            <button type="submit" class="mt-2 inline-flex items-center bg-biblioteca-700 text-white px-6 py-2 rounded-lg font-medium hover:bg-biblioteca-800 transition-colors duration-300">
                                <span wire:loading.remove wire:target="adicionarComentario">Publicar Comentário</span>
                                <span wire:loading wire:target="adicionarComentario" class="flex items-center">
                                    <span class="border-t-transparent border-solid animate-spin rounded-full border-white border-2 h-4 w-4 mr-2"></span>
                                    Publicando...
                                </span>
                            </button>
                        </div>
                    </form>
                @else
                    <div class="text-center p-6 bg-biblioteca-50 border border-biblioteca-200 rounded-lg">
                        <i class="bi bi-lock-fill text-3xl text-biblioteca-500 mb-3"></i>
                        <p class="font-semibold text-biblioteca-700">Apenas membros podem comentar.</p>
                        <p class="text-biblioteca-600">Entre para o clube para participar da discussão!</p>
                    </div>
                @endif

                <div class="space-y-6">
                    @forelse($comentarios as $comentario)
                        <div class="flex items-start gap-4">
                            <span class="block h-12 w-12 rounded-full bg-biblioteca-100 overflow-hidden">
                                @if ($comentario->user->profile_photo_path)
                                    <img src="{{ asset('storage/' . $comentario->user->profile_photo_path) }}" alt="Avatar" class="h-full w-full object-cover">
                                @else
                                    <div class="h-full w-full flex items-center justify-center bg-biblioteca-100 text-biblioteca-600 font-semibold">
                                        {{ \App\Services\CommumFunctions::getIniciais($comentario->user->name) }}
                                    </div>
                                @endif
                            </span>
                            <div class="flex-1 bg-biblioteca-50 border border-biblioteca-200 rounded-lg p-4">
                                <div class="flex justify-between items-center mb-1">
                                    <span class="font-bold text-biblioteca-800">{{ $comentario->user->name }}</span>
                                    <span class="text-xs text-biblioteca-500">{{ $comentario->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-biblioteca-700">{{ $comentario->texto }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-6">
                            <i class="bi bi-chat-quote text-4xl text-biblioteca-400 mb-3"></i>
                            <p class="text-biblioteca-600">Nenhum comentário ainda.</p>
                            <p class="text-sm text-biblioteca-500">Seja o primeiro a compartilhar suas ideias!</p>
                        </div>
                    @endforelse
                </div>

            </section>
        </main>

        <aside class="w-full md:w-1/4 lg:w-1/5">
            <div class="sticky top-10 space-y-8">
                <div class="bg-white rounded-xl shadow-md border border-biblioteca-200 p-5">
                    <h3 class="text-xl font-bold text-biblioteca-800 mb-4 flex items-center gap-2">
                        <i class="bi bi-people-fill"></i>
                        Membros ({{ $membros->count() }})
                    </h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($membros->take(12) as $membro)
                            @php $isCurrentUser = $membro->id === auth()->id(); @endphp

                            @if ($membro->profile_photo_path)
                                <img src="{{ asset('storage/' . $membro->profile_photo_path) }}"
                                     alt="{{ $membro->name }}"
                                     class="w-10 h-10 rounded-full object-cover @if($isCurrentUser) border-2 border-biblioteca-700 @endif"
                                     title="{{ $membro->name }} @if($isCurrentUser) (Você) @endif">
                            @else
                                <div class="w-10 h-10 rounded-full flex items-center justify-center font-semibold
                                     @if($isCurrentUser) bg-biblioteca-700 text-white @else bg-biblioteca-200 text-biblioteca-600 @endif"
                                     title="{{ $membro->name }} @if($isCurrentUser) (Você) @endif">
                                    {{ \App\Services\CommumFunctions::getIniciais($membro->name) }}
                                </div>
                            @endif
                        @endforeach

                        @if($membros->count() > 12)
                            <div class="w-10 h-10 rounded-full flex items-center justify-center bg-biblioteca-100 text-biblioteca-600 font-semibold"
                                 title="e mais {{ $membros->count() - 12 }}...">
                                +{{ $membros->count() - 12 }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md border border-biblioteca-200 p-5">
                    <h3 class="text-xl font-bold text-biblioteca-800 mb-4 flex items-center gap-2">
                        <i class="bi bi-book-half"></i>
                        Livros Anteriores
                    </h3>
                    <div class="space-y-4">
                        @forelse($sessoesAnteriores as $sessao)
                            <a href="#" class="flex items-center gap-3 group">
                                <img src="{{ $sessao->livro->formatos->first()->url ?? 'https://placehold.co/50x75/c08550/FFFFFF?text=Capa' }}"
                                     alt="Capa {{ $sessao->livro->titulo }}"
                                     class="w-12 h-[72px] object-cover rounded shadow-sm">
                                <div>
                                    <h4 class="font-semibold text-biblioteca-800 group-hover:text-biblioteca-600">{{ $sessao->livro->titulo }}</h4>
                                    <p class="text-sm text-biblioteca-600">{{ $sessao->livro->autores->pluck('nome')->implode(', ') }}</p>
                                </div>
                            </a>
                        @empty
                            <p class="text-sm text-biblioteca-500">Nenhum livro anterior registrado.</p>
                        @endforelse
                    </div>
                </div>

            </div>
        </aside>

    </div>
</div>

