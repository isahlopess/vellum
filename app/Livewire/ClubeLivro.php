<?php

namespace App\Livewire;

use App\Models\ClubeComentario;
use App\Models\ClubeMembro;
use App\Models\ClubeSessao;
use App\Models\Livro;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.menu')]
#[Title('Clube do Livro')]
class ClubeLivro extends Component
{
    public $sessaoAtiva;
    public $comentarios;
    public $membros;
    public $sessoesAnteriores;
    public $novoComentario = '';

    public function mount()
    {
        $this->sessaoAtiva = ClubeSessao::with('livro.autores', 'livro.formatos')
            ->where('status', 'ativo')
            ->first();

        $this->sessoesAnteriores = ClubeSessao::with('livro.autores', 'livro.formatos')
            ->where('status', 'lido')
            ->latest('data_discussao')
            ->limit(2)
            ->get();

        $this->recarregarMembros();

        if ($this->sessaoAtiva) {
            $this->comentarios = $this->sessaoAtiva->comentarios()
                ->with('user')
                ->latest()
                ->get();
        } else {
            $this->comentarios = collect();
        }
    }

    public function entrarClube()
    {
        if (!auth()->user()->is_membro_clube) {
            ClubeMembro::create(['user_id' => auth()->id()]);
            $this->recarregarMembros();

            Auth::setUser(User::find(auth()->id()));
            unset(auth()->user()->is_membro_clube);
        }
    }

    public function sairClube()
    {
        if (auth()->user()->is_membro_clube) {
            auth()->user()->inscricaoClube->delete();
            $this->recarregarMembros();

            Auth::setUser(User::find(auth()->id()));
            unset(auth()->user()->is_membro_clube);
        }
    }

    public function recarregarMembros()
    {
        $membroIds = ClubeMembro::pluck('user_id');
        $this->membros = User::whereIn('id', $membroIds)->get();
    }

    public function adicionarComentario()
    {
        $this->validate(['novoComentario' => 'required|string|min:3']);
        if (!$this->sessaoAtiva) return;

        $this->sessaoAtiva->comentarios()->create([
            'user_id' => auth()->id(),
            'texto' => $this->novoComentario
        ]);

        $this->novoComentario = '';
        $this->comentarios = $this->sessaoAtiva->comentarios()->with('user')->latest()->get();
        session()->flash('comentario_status', 'Comentário publicado!');
    }

    public function render()
    {
        return view('livewire.clube-do-livro');
    }
}

