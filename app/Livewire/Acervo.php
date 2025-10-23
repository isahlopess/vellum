<?php

namespace App\Livewire;

use App\Models\Livro;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.menu')]
#[Title('Acervo Digital')]
class Acervo extends Component
{
    public $livros;

    public function mount()
    {
        $this->livros = Livro::select('titulo', 'resumo', 'numero_downloads')
            ->orderBy('numero_downloads', 'desc')
            ->take(12)
            ->get();
    }

    public function render()
    {
        return view('livewire.acervo-digital');
    }
}
