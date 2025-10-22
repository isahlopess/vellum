<?php

namespace Database\Seeders;

use App\Models\Livro;
use App\Services\ApiLivrosService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;

class LivroSeeder extends Seeder
{
    public function run($livrosPorPagina): void
    {
            foreach ($livrosPorPagina as $pagina => $livrosPagina) {
                echo "Inserindo livros da página " . ($pagina + 1) . "...\n";

                foreach($livrosPagina as $livro) {
                    $dados = [
                        'titulo' => $livro['title'],
                        'numero_downloads' => $livro['download_count'],
                        'resumo' => $livro['summaries'][0] ?? null
                    ];
                    Livro::create($dados);
                }
            }
    }
}
