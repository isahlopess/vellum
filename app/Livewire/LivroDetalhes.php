<?php

namespace App\Livewire;

use App\Models\Livro;
use Livewire\Component;
use Livewire\Attributes\On;

class LivroDetalhes extends Component
{
    public $livro;
    public $showModal = false;

    #[On('openLivroModal')]
    public function mostrarDetalhes($livroId)
    {
        $this->livro = Livro::with([
            'autores:id,nome',
            'assuntos:id,nome',
            'estantes:id,nome',
            'formatos:id,url,media_type,livro_id'
        ])->findOrFail($livroId);
        
        $this->showModal = true;
    }   

    public function closeModal()
    {
        $this->showModal = false;
        $this->livro = null;
    }

    public function render()
    {
        return view('livewire.livro-detalhes');
    }
}