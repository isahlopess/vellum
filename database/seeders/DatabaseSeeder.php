<?php

namespace Database\Seeders;

use App\Models\Livro;
use App\Models\User;
use App\Services\ApiLivrosService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use function Webmozart\Assert\Tests\StaticAnalysis\integer;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $apiLivros = app(ApiLivrosService::class);

        $livrosPorPagina = iterator_to_array($apiLivros->buscarPaginas('books', 10));

        $this->callWith(LivroSeeder::class, ['livrosPorPagina' => $livrosPorPagina]);
        $this->callWith(AutorSeeder::class, ['livrosPorPagina' => $livrosPorPagina]);
    }
}
