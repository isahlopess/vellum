<?php

namespace App\Livewire;

use App\Models\Livro;
use App\Models\LivroFavorito;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.menu')]
#[Title('Tela Inicial')]
class Dashboard extends Component
{
    public Collection $topDownloads;
    public Collection $topRomances;
    public Collection $topFantasias;
    public Collection $topAventuras;
    public Collection $topHorror;
    public Collection $topFiccao;
    public Collection $topHistoria;
    public Collection $meusFavoritos;

    public function mount()
    {
        $this->loadLivros();
    }

    private function loadLivros()
    {
        $withRelations = [
            'autores:id,nome',
            'assuntos:id,nome',
            'estantes:id,nome',
            'formatos:id,url,media_type,livro_id'
        ];

        $this->topDownloads = $this->getLivrosQuery($withRelations)
            ->orderBy('livros.numero_downloads', 'DESC')
            ->limit(15)
            ->get();

        $this->topRomances = $this->getLivrosPorGenero('romance');
        $this->topFantasias = $this->getLivrosPorGenero('fantasia');
        $this->topAventuras = $this->getLivrosPorGenero('aventura');
        $this->topHorror = $this->getLivrosPorGenero('horror');
        $this->topFiccao = $this->getLivrosPorGenero('ficção');
        $this->topHistoria = $this->getLivrosPorGenero('história');

        $this->meusFavoritos = auth()->check()
            ? $this->getFavoritosUsuario(auth()->id())
            : collect();
    }

    private function getLivrosQuery(array $withRelations = [])
    {
        return Livro::select('id', 'titulo', 'numero_downloads')
            ->with($withRelations);
    }

    private function getLivrosPorGenero(string $genero)
    {
        return $this->getLivrosQuery()
            ->whereHas('estantes', fn($q) => $q->where('nome', 'like', "%{$genero}%"))
            ->orderBy('numero_downloads', 'DESC')
            ->limit(15)
            ->get();
    }

    private function getFavoritosUsuario($userId)
    {
        $favoritoIds = LivroFavorito::where('user_id', $userId)
            ->pluck('livro_id');

        return $this->getLivrosQuery()
            ->whereIn('id', $favoritoIds)
            ->get();
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
