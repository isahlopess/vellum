<?php

namespace Database\Seeders;

use App\Models\Assunto;
use App\Models\Estante;
use App\Models\Formato;
use App\Models\Idioma;
use App\Models\Livro;
use App\Models\Autor;
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

                $resumo = $livro['summaries'][0] ?? '';
                $textoResumo = is_array($resumo)
                    ? implode('; ', array_slice($resumo, 0, 3))
                    : $resumo;

                $resumoTraduzido = !empty($textoResumo)
                    ? $this->traduzirTexto($textoResumo)
                    : null;

                $livroCriado = Livro::create([
                    'titulo' => $tituloTraduzido,
                    'numero_downloads' => $livro['download_count'],
                    'resumo' => $resumoTraduzido
                ]);

                foreach ($livro['authors'] as $autorData) {
                    $autor = Autor::firstOrCreate(
                        ['nome' => $autorData['name'] ?? 'Desconhecido'],
                        [
                            'dt_nascimento' => $autorData['birth_year'] ?? null,
                            'dt_falecimento' => $autorData['death_year'] ?? null
                        ]
                    );
                    $livroCriado->autores()->attach($autor->id);
                }
                foreach($livro['bookshelves'] as $estanteData) {
                    $estante = Estante::firstOrCreate(['nome' => $this->traduzirTexto($estanteData)]);
                    $livroCriado->estantes()->attach($estante->id);
                }
                foreach($livro['languages'] as $idiomaData){
                    $idioma = Idioma::firstOrCreate(['code' => $idiomaData]);
                    $livroCriado->idiomas()->attach($idioma->id);
                }
                foreach($livro['subjects'] as $assuntoData){
                    $assunto = Assunto::firstOrCreate(['nome' => $this->traduzirTexto($assuntoData)]);
                    $livroCriado->assuntos()->syncWithoutDetaching([$assunto->id]);
                }
                foreach ($livro['formats'] as $mediaType => $url) {
                    if (str_contains($mediaType, 'image/jpeg')) {
                        Formato::firstOrCreate([
                            'livro_id' => $livroCriado->id,
                            'media_type' => $mediaType,
                            'url' => $url
                        ]);
                    }
                }
            }
        }
    }

    private function traduzirTexto(string $texto, string $target = 'pt'): string
    {
        if (empty($texto)) return $texto;

        $apiKey = env('GOOGLE_TRANSLATE_API_KEY');
        if (empty($apiKey)) {
            echo "\nERRO: variável GOOGLE_TRANSLATE_API_KEY ausente no .env.\n";
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

            echo "\nErro ao traduzir texto: {$texto}\n";
        } catch (\Exception $e) {
            Log::error('Falha na tradução', ['erro' => $e->getMessage()]);
        }

        return $texto;
    }
}
