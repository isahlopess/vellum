<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.menu')]
#[Title('Clube do Livro')]
class ClubeLivro extends Component
{
    public function render()
    {
        return view('livewire.clube-do-livro');
    }
}
