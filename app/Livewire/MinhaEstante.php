<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.menu')]
#[Title('Sua estante')]
class MinhaEstante extends Component
{


    public function render()
    {
        return view('livewire.minha-estante');
    }
}
