<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Pool; 
use App\Models\Livro; 

class LivroSeeder extends Seeder
{
    public function run(): void
    {
        $totalPaginas = 10;

        try {
            $responses = Http::pool(function (Pool $pool) use ($totalPaginas) {
                $requests = [];
                for ($paginaAtual = 1; $paginaAtual <= $totalPaginas; $paginaAtual++) {
                    $requests[] = $pool->timeout(60)->get("https://gutendex.com/books?page={$paginaAtual}");
                }
                return $requests;
            }); 

            foreach ($responses as $index => $response) {
                $paginaProcessada = $index + 1; 

                if ($response->successful()) {
                    $data = $response->json();
                    
                    if (isset($data['results'])) {
                        $livros = $data['results'];
                        foreach($livros as $livro){
                           $dados = [
                                'titulo' => $livro['title'],
                                'numero_downloads' => $livro['download_count'],
                                'resumo' => $livro['summaries'][0] ?? null
                            ];

                            Livro::Create($dados);
                        }
                        echo "Página processada: " . $paginaProcessada . "\n";
                    } else {
                        $this->command->error("API não retornou 'results' para a página: " . $paginaProcessada);
                    }
                } else {
                    $this->command->error("Falha ao buscar página: " . $paginaProcessada . " (HTTP Status: " . $response->status() . ")");
                }
            }

        } catch (ConnectionException $e) {
            $this->command->error("Falha ao conectar na API: " . $e->getMessage());
        }
    }
}