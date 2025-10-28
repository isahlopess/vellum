<?php

namespace App\Livewire;

use App\Models\Autor;
use App\Models\Livro;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.menu')]
#[Title('Acervo Digital')]
class Acervo extends Component
{
    use WithPagination;

    /** @var string */
    public $busca = '';

    /** @var string */
    public $ordenar = 'populares';

    /** @var array */
    public $generosSelecionados = [];

    /** @var array */
    public $autoresSelecionados = [];

    /** @var array */
    public $generos;

    /** @var \Illuminate\Database\Eloquent\Collection */
    public $autores;

    public function mount()
    {
        $mainGenreKeywords = [
            'Romance' => 'romance',
            'Fantasia' => 'fantasia',
            'Aventura' => 'aventura',
            'Horror' => 'horror',
            'Ficção' => 'ficção',
            'História' => 'históri',
        ];

        $groupedGenresData = [];

        foreach ($mainGenreKeywords as $displayName => $keyword) {

            $count = Livro::whereHas('assuntos', function ($q) use ($keyword) {
                $q->where('nome', 'like', "%$keyword%");
            })->count();

            if ($count > 0) {
                $groupedGenresData[] = [
                    'nome' => $displayName,
                    'valor' => $keyword,
                    'livros_count' => $count,
                ];
            }
        }
        $this->generos = $groupedGenresData;

        $this->autores = Autor::select('id', 'nome')
            ->whereHas('livros')
            ->withCount('livros')
            ->orderBy('nome', 'asc')
            ->get();
    }

    public function updating($key): void
    {
        if (in_array($key, ['busca', 'ordenar', 'generosSelecionados', 'autoresSelecionados'])) {
            $this->resetPage();
        }
    }

    public function limparFiltros()
    {
        $this->reset('busca', 'generosSelecionados', 'autoresSelecionados');
        $this->ordenar = 'populares';
        $this->resetPage();
    }

    public function render()
    {
        $query = Livro::query()
            ->with(['autores:id,nome', 'formatos:id,url,media_type,livro_id']);

        if (!empty($this->busca)) {
            $query->where(function ($q) {
                $q->where('titulo', 'like', '%' . $this->busca . '%')
                    ->orWhereHas('autores', function ($subQuery) {
                        $subQuery->where('nome', 'like', '%' . $this->busca . '%');
                    });
            });
        }

        if (!empty($this->generosSelecionados)) {
            $query->where(function ($q) {
                foreach ($this->generosSelecionados as $generoKeyword) {
                    $q->orWhereHas('assuntos', function ($subQuery) use ($generoKeyword) {
                        $subQuery->where('nome', 'like', '%' . $generoKeyword . '%');
                    });
                }
            });
        }

        if (!empty($this->autoresSelecionados)) {
            $query->whereHas('autores', function ($q) {
                $q->whereIn('autores.id', $this->autoresSelecionados);
            });
        }

        switch ($this->ordenar) {
            case 'recentes':
                $query->orderBy('created_at', 'desc');
                break;
            case 'az':
                $query->orderBy('titulo', 'asc');
                break;
            case 'za':
                $query->orderBy('titulo', 'desc');
                break;
            case 'populares':
            default:
                $query->orderBy('numero_downloads', 'desc');
                break;
        }

        $livros = $query->paginate(20);
        return view('livewire.acervo-digital', [
            'livros' => $livros
        ]);
    }
}
