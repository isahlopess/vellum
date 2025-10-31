<?php

namespace App\Livewire;

use App\Models\Livro;
use App\Models\LivroFavorito;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.menu')]
#[Title('Sua estante')]
class MinhaEstante extends Component
{
    public $livrosFavoritos;

    public $busca = '';

    public $idUsuario;
    public function mount(){
        $this->idUsuario = Auth()->id();
    }

    public function render()
    {
        if($this->busca == ''){
            $this->livrosFavoritos = Livro::whereHas('livrosFavoritos', function ($query) {
                $query->where('user_id', $this->idUsuario);
            })->get();
        } else{
            $this->livrosFavoritos = Livro::whereHas('livrosFavoritos', function ($query) {
                $query->where('user_id', $this->idUsuario);
                $query->where('titulo', 'like', '%' . $this->busca . '%');
            })->get();
        }
        return view('livewire.minha-estante');
    }
}
