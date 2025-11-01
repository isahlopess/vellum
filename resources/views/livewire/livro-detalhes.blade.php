<div>
    @if($showModal && $livro)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
            
            <div class="fixed inset-0 bg-gray-900 bg-opacity-75" wire:click="closeModal"></div>

            <div class="bg-white rounded-lg max-w-4xl w-full max-h-[90vh] overflow-hidden relative z-10">
                <div class="flex justify-between items-center p-6 border-b">
                    <h2 class="text-2xl font-bold text-gray-800">{{ $livro->titulo }}</h2>
                    <button wire:click="closeModal" class="text-gray-500 hover:text-gray-700">
                        <i class="bi bi-x-lg text-xl"></i>
                    </button>
                </div>

                <div class="p-6 overflow-y-auto max-h-[calc(90vh-200px)]">
                    <div class="flex flex-col md:flex-row gap-6 mb-6">
                        <div class="flex-shrink-0">
                            @if($livro->formatos->first()->url ?? null)
                                <img src="{{ $livro->formatos->first()->url }}" 
                                     alt="Capa do livro {{ $livro->titulo }}"
                                     class="w-48 h-64 object-cover rounded-lg shadow-md">
                            @else
                                <div class="w-48 h-64 bg-biblioteca-100 flex items-center justify-center rounded-lg">
                                    <i class="bi bi-book text-6xl text-biblioteca-400"></i>
                                </div>
                            @endif
                        </div>

                        <div class="flex-1">
                            <div class="mb-4">
                               <h3 class="font-semibold text-gray-700 mb-2">Autores</h3>
                               <div class="flex flex-wrap gap-2">
                                   @foreach($livro->autores as $autor)
                                       <span class="bg-biblioteca-100 text-biblioteca-800 px-3 py-1 rounded-full text-sm">
                                           {{ $autor->nome }}
                                       </span>
                                   @endforeach
                               </div>
                            </div>
                            </div>
                    </div>

                    @if($livro->resumo)
                        <div class="border-t pt-4">
                            <h3 class="font-semibold text-gray-700 mb-3">Resumo</h3>
                            <p class="text-gray-600 leading-relaxed text-justify">
                                {{ $livro->resumo }}
                            </p>
                        </div>
                    @endif
                </div>

                <div class="border-t p-4 bg-gray-50 flex justify-end gap-3">
                    <button 
                        wire:click="closeModal" 
                        class="px-6 py-2 text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-100 transition-colors"
                    >
                        Fechar
                    </button>
                    <button class="px-6 py-2 bg-biblioteca-500 text-white rounded-lg hover:bg-biblioteca-600 transition-colors">
                    <i class="bi bi-book mr-2"></i>
                        Ler Livro
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>