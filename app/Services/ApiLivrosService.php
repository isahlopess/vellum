<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;
class ApiLivrosService
{
    public function buscarPaginas($endpoint, $totalPaginas = 5)
    {
        for ($pagina = 1; $pagina <= $totalPaginas; $pagina++) {
            $url = "https://gutendex.com/{$endpoint}/?page={$pagina}";

            try {
                $response = Http::timeout(60)->get($url);

                if (!$response->successful()) {
                    echo "Erro na página {$pagina} ({$response->status()})\n";
                    continue;
                }

                $data = $response->json();

                if (!isset($data['results'])) {
                    echo "Sem resultados na página {$pagina}\n";
                    continue;
                }

                yield $data['results'];

            } catch (ConnectionException $e) {
                echo "Falha ao conectar na página {$pagina}: " . $e->getMessage() . "\n";
            }
        }
    }
}
