<?php

namespace App\Livewire;

use App\Models\Livro;
use Livewire\Component;

class LivroDetalhes extends Component
{
    public $livro;

    public function mostrarDetalhes($livroId)
    {
        $this->livro = Livro::with([
            'autores:id,nome',
            'assuntos:id,nome',
            'estantes:id,nome',
            'formatos:id,url,media_type,livro_id'
        ])->findOrFail($livroId);
    }

    public function render()
    {
        return view('livewire.livro-detalhes');
    }
}
