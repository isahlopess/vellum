<?php

namespace Database\Seeders;

use App\Models\Autor;
use App\Services\ApiLivrosService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AutorSeeder extends Seeder
{
    public function run($livrosPorPagina): void
    {
       foreach ($$livrosPorPagina as $pagina => $livrosPagina) {
           echo "Processando página " . ($pagina + 1) . "\n";
           foreach($livrosPagina as $livro){
               $dados = [
                   'nome' => $livro['authors']['name'],
                   'dt_nascimento' => $livro['authors']['birth_year'],
                   'dt_falecimento' => $livro['authors']['death_year'],
               ];
                Autor::create($dados);
           }
       }
    }
}
