<?php

namespace App\Livewire;

use App\Services\CommumFunctions;
use Livewire\Component;

class LivroCard extends Component
{
    public $livro;
    public $isFavorito;
    public $livroId;
    public $size = 'default';

    public function mount($livro)
    {
        $this->livro = $livro;
        $this->livroId = is_array($livro) ? $livro['id'] : $livro->id;

        $this->checkFavoriteStatus();
    }

    public function toggleFavorite($livroId, CommumFunctions $commonFunctions)
    {
        try {
            if ($this->isFavorito) {
                $result = $commonFunctions->removeFavorite($livroId);
            } else {
                $result = $commonFunctions->addFavorite($livroId);
            }

            if ($result['success']) {
                $this->isFavorito = !$this->isFavorito;

                $this->dispatch('favorite-updated',
                    message: $result['message'],
                    isFavorito: $this->isFavorito
                );
            } else {
                $this->dispatch('favorite-error',
                    message: $result['message']
                );
            }

        } catch (\Exception $e) {
            $this->dispatch('favorite-error',
                message: 'Erro ao processar favorito: ' . $e->getMessage()
            );
        }
    }

    private function checkFavoriteStatus()
    {
        if (auth()->check()) {
            $commonFunctions = app(CommumFunctions::class);
            $this->isFavorito = $commonFunctions->isFavorite($this->livroId);
        } else {
            $this->isFavorito = false;
        }
    }

    #[On('user-status-changed')]
    public function updateFavoriteStatus()
    {
        $this->checkFavoriteStatus();
    }

    public function render()
    {
        return view('livewire.livro-card');
    }
}
