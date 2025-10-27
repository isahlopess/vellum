<?php

namespace App\Livewire;

use App\Models\Livro;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

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

        $this->topRomances = $this->buscarLivrosPorGenero('romance');
        $this->topFantasias = $this->buscarLivrosPorGenero('fantasia');
        $this->topAventuras = $this->buscarLivrosPorGenero('aventura');
        $this->topHorror = $this->buscarLivrosPorGenero('horror');
        $this->topFiccao = $this->buscarLivrosPorGenero('ficção');
        $this->topHistoria = $this->buscarLivrosPorGenero('históri');

    }

    public function buscarLivrosPorGenero($genero) {
        return Livro::select('id', 'livros.titulo', 'livros.numero_downloads')
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
    }
    public function render()
    {
        return view('livewire.dashboard');
    }
}
