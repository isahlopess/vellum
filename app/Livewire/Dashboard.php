<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.menu')] 
#[Title('Tela Inicial')] 
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard');
    }
}