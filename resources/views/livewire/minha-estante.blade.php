<div class="mx-auto">

    <div class="mb-10 text-center md:text-left">
        <h2 class="text-4xl font-bold text-biblioteca-800 mb-2">Sua Estante</h2>
        <p class="text-lg text-biblioteca-600">Análise seus livros lidos, favoritos e em leitura na sua estante.</p>
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
            <select wire:model.live="ordenar" class="w-full md:w-auto p-3 rounded-lg border border-biblioteca-300 focus:outline-none focus:ring-2 focus:ring-biblioteca-500 bg-white">
                <option value="populares">⭐ Sua avaliação</option>
                <option value="1">★☆☆☆☆ 1 estrela</option>
                <option value="2">★★☆☆☆ 2 estrelas</option>
                <option value="3">★★★☆☆ 3 estrelas</option>
                <option value="4">★★★★☆ 4 estrelas</option>
                <option value="5">★★★★★ 5 estrelas</option>
            </select>
        </div>
    </div>

    <div class="flex flex-col md:flex-row gap-8 lg:gap-12">

        <main class="w-full">
            <div wire:loading class="w-full mb-6">
                <div class="flex items-center justify-center gap-3 bg-biblioteca-100 p-4 rounded-lg">
                    <i class="bi bi-arrow-clockwise text-2xl text-biblioteca-700 animate-spin"></i>
                    <span class="font-medium text-biblioteca-700">Atualizando estante...</span>
                </div>
            </div>

            <div class="mb-6">
                <h3 id="downloads-title" class="text-2xl font-bold text-biblioteca-800 flex items-center gap-2">
                    <i class="bi bi-heart-fill text-red-500"></i>
                    <span>Favoritos</span>
                </h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                @forelse($livrosFavoritos as $livro)
                    <livewire:livro-card
                        :livro="$livro"
                        :key="$livro->id"
                        size="large" />
                @empty
                    <div class="col-span-full text-center py-12 bg-white border border-biblioteca-200 rounded-lg shadow-sm">
                        <i class="bi bi-search-heart text-5xl text-biblioteca-400 mb-4"></i>
                        <h4 class="text-xl font-bold text-biblioteca-700">Nenhum livro encontrado</h4>
                        <p class="text-biblioteca-600">Tente ajustar seus termos de busca ou filtros.</p>
                    </div>
                @endforelse
            </div>
        </main>
    </div>
</div>
