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
    public $livros;

    public function mount()
    {
        $this->livros = Livro::select('id', 'livros.titulo', 'livros.numero_downloads')
        ->with(['autores:id,nome',
            'assuntos:id,nome',
            'estantes:id,nome',
            'formatos:id,url,media_type,livro_id'
            ])
            ->get();
    }
    public function render()
    {
        return view('livewire.dashboard');
    }
}
