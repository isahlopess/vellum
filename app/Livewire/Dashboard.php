<?php

namespace App\Livewire;

use App\Models\Livro;
use App\Models\LivroFavorito;
use App\Services\CommumFunctions;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.menu')]
#[Title('Tela Inicial')]
class Dashboard extends Component
{
    public $topDownloads;

    public $topRomances;

    public $topFantasias;

    public $topAventuras;

    public $topHorror;

    public $topFiccao;

    public $topHistoria;

    public $meusFavoritos;

    public function mount()
    {
        $this->topDownloads = Livro::select('id', 'livros.titulo', 'livros.numero_downloads')
            ->with(['autores:id,nome',
                'assuntos:id,nome',
                'estantes:id,nome',
                'formatos:id,url,media_type,livro_id'
            ])
            ->orderBy('livros.numero_downloads', 'DESC')
            ->limit(15)
            ->get();

        $this->carregarFavoritos($this->topDownloads);

        $this->topRomances = $this->buscarLivrosPorGenero('romance');
        $this->topFantasias = $this->buscarLivrosPorGenero('fantasia');
        $this->topAventuras = $this->buscarLivrosPorGenero('aventura');
        $this->topHorror = $this->buscarLivrosPorGenero('horror');
        $this->topFiccao = $this->buscarLivrosPorGenero('ficção');
        $this->topHistoria = $this->buscarLivrosPorGenero('históri');

        if (auth()->check()) {
            $favoritoIds = LivroFavorito::where('user_id', auth()->id())->pluck('livro_id');

            $this->meusFavoritos = Livro::select('id', 'livros.titulo', 'livros.numero_downloads')
                ->with([
                    'autores:id,nome',
                    'assuntos:id,nome',
                    'estantes:id,nome',
                    'formatos:id,url,media_type,livro_id'
                ])
                ->whereIn('id', $favoritoIds)
                ->get();

            $this->carregarFavoritos($this->meusFavoritos);
        } else {
            $this->meusFavoritos = collect();
        }
    }

    private function carregarFavoritos($livros){
        if (auth()->check()){
            $commomFunctions = app(CommumFunctions::class);

            foreach ($livros as $livro){
                $commomFunctions->isFavorite($livro);
            }
        }
    }

    public function buscarLivrosPorGenero($genero) {
        $livros = Livro::select('id', 'livros.titulo', 'livros.numero_downloads')
            ->with([
                'autores:id,nome',
                'assuntos:id,nome',
                'estantes:id,nome',
                'formatos:id,url,media_type,livro_id'
            ])
            ->orderBy('livros.numero_downloads', 'DESC')
            ->whereHas('estantes', function ($query) use ($genero) {
                $query->where('nome', 'like', "%$genero%");
            })
            ->limit(15)
            ->get();
        $this->carregarFavoritos($livros);

        return $livros;
    }
    public function render()
    {
        return view('livewire.dashboard');
    }
}
