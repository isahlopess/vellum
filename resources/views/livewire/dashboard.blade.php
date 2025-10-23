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

            <a href="{{ route(('clube-do-livro')) }}" class="inline-block bg-biblioteca-700 text-white px-8 py-2 rounded-lg font-medium hover:bg-biblioteca-800 transition-colors duration-300">
                Ir
            </a>
        </div>

    </div>

    <div class="mt-12">
        <h3 class="text-2xl font-bold text-biblioteca-800 mb-6">Destaques do Acervo</h3>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">

            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                <img src="https://via.placeholder.com/300x450?text=O+Nome+do+Vento"
                     alt="Capa do livro O Nome do Vento"
                     class="w-full object-cover aspect-[2/3]">
                <div class="p-4">
                    <h4 class="font-bold text-biblioteca-800 text-md truncate" title="O Nome do Vento">O Nome do Vento</h4>
                    <p class="text-biblioteca-600 text-sm">Patrick Rothfuss</p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                <img src="http://googleusercontent.com/image_collection/image_retrieval/14725597102869192089_0"
                     alt="Capa do livro Duna"
                     class="w-full object-cover aspect-[2/3]">
                <div class="p-4">
                    <h4 class="font-bold text-biblioteca-800 text-md truncate" title="Duna">Duna</h4>
                    <p class="text-biblioteca-600 text-sm">Frank Herbert</p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                <img src="http://googleusercontent.com/image_collection/image_retrieval/7380465370731016121_0"
                     alt="Capa do livro A Biblioteca da Meia-Noite"
                     class="w-full object-cover aspect-[2/3]">
                <div class="p-4">
                    <h4 class="font-bold text-biblioteca-800 text-md truncate" title="A Biblioteca da Meia-Noite">A Biblioteca da...</h4>
                    <p class="text-biblioteca-600 text-sm">Matt Haig</p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                <img src="http://googleusercontent.com/image_collection/image_retrieval/5541979796701296701_0"
                     alt="Capa do livro O Senhor dos Anéis"
                     class="w-full object-cover aspect-[2/3]">
                <div class="p-4">
                    <h4 class="font-bold text-biblioteca-800 text-md truncate" title="O Senhor dos Anéis">O Senhor dos Anéis</h4>
                    <p class="text-biblioteca-600 text-sm">J.R.R. Tolkien</p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                <img src="http://googleusercontent.com/image_collection/image_retrieval/12205063613289769539_0"
                     alt="Capa do livro 1984"
                     class="w-full object-cover aspect-[2/3]">
                <div class="p-4">
                    <h4 class="font-bold text-biblioteca-800 text-md truncate" title="1984">1984</h4>
                    <p class="text-biblioteca-600 text-sm">George Orwell</p>
                </div>
            </div>

        </div>
    </div>
</div>
