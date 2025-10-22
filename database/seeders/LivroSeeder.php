<?php

namespace Database\Seeders;

use App\Models\Livro;
use App\Services\ApiLivrosService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LivroSeeder extends Seeder
{
    public function run($livrosPorPagina): void
    {
        foreach ($livrosPorPagina as $pagina => $livrosPagina) {
            echo "Inserindo livros da página " . ($pagina + 1) . "...\n";

            foreach ($livrosPagina as $livro) {
                $tituloTraduzido = $this->traduzirTexto($livro['title']);

                $assuntos = $livro['subjects'] ?? [];
                $textoAssuntos = implode('; ', array_slice($assuntos, 0, 3));

                $resumoTraduzido = null;
                if (!empty($textoAssuntos)) {
                    $resumoTraduzido = $this->traduzirTexto($textoAssuntos);
                }

                $dados = [
                    'titulo' => $tituloTraduzido,
                    'numero_downloads' => $livro['download_count'],
                    'resumo' => $resumoTraduzido
                ];

                Livro::create($dados);
            }
        }
    }

    private function traduzirTexto(string $texto, string $target = 'pt'): string
    {
        if (empty($texto)) {
            return $texto;
        }

        $apiKey = env('GOOGLE_TRANSLATE_API_KEY');
        if (empty($apiKey)) {
            echo "\nERRO GRAVE: A variável GOOGLE_TRANSLATE_API_KEY não foi encontrada.\n";
            echo "Verifique seu arquivo .env e limpe o cache com 'php artisan config:clear'.\n";
            return $texto;
        }

        $url = 'https://translation.googleapis.com/language/translate/v2';

        try {
            $response = Http::get($url, [
                'q' => $texto,
                'target' => $target,
                'format' => 'text',
                'key' => $apiKey
            ]);

            if ($response->successful()) {
                return $response->json('data.translations.0.translatedText');
            }

            $status = $response->status();
            $corpoErro = $response->body();

            echo "\n=================================================\n";
            echo "ERRO DE API ao traduzir: {$status}\n";
            echo "Texto original: {$texto}\n";
            echo "Resposta da API: {$corpoErro}\n";
            echo "=================================================\n";

            Log::error('Falha na API de Tradução', [
                'status' => $status,
                'response' => $corpoErro,
                'texto' => $texto
            ]);

        } catch (\Exception $e) {
            echo "\n=================================================\n";
            echo "ERRO DE CONEXÃO HTTP ao tentar traduzir\n";
            echo "Verifique sua conexão ou configuração de SSL (cURL).\n";
            echo "Erro: " . $e->getMessage() . "\n";
            echo "=================================================\n";
            Log::error('Falha na Conexão com API de Tradução', ['erro' => $e->getMessage()]);
        }

        return $texto;
    }
}
