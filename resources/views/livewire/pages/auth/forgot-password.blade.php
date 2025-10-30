<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $email = '';

    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        $status = Password::sendResetLink(
            $this->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));
            return;
        }

        $this->reset('email');
        session()->flash('status', __($status));
    }
}; ?>

<div>
    <div class="text-center">
        <img class="mx-auto h-20 w-auto" src="{{ asset('imagens/logo_icon.png') }}" alt="Vellum Logo">
        <h2 class="mt-6 text-3xl font-bold text-biblioteca-800">
            Esqueceu sua senha?
        </h2>
    </div>

    <div class="mt-4 mb-4 text-sm text-gray-600 text-center">
        {{ __('Sem problemas. Apenas nos informe seu e-mail e enviaremos um link para você criar uma nova senha.') }}
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="sendPasswordResetLink" class="space-y-6">

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-sm font-bold text-gray-700 tracking-wide"/>
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-6">
            <button type="submit"
                    class="w-full flex justify-center bg-biblioteca-700 text-white p-3 rounded-lg font-semibold tracking-wide
                           focus:outline-none focus:shadow-outline hover:bg-biblioteca-800 shadow-lg
                           cursor-pointer transition ease-in duration-300">
                {{ __('Enviar link de redefinição') }}
            </button>
        </div>

        <p class="flex flex-col items-center justify-center mt-6 text-center text-md text-gray-500">
            <a href="{{ route('login') }}" class="text-biblioteca-700 hover:text-biblioteca-800 no-underline hover:underline cursor-pointer transition ease-in duration-300" wire:navigate>
                {{ __('Voltar ao login') }}
            </a>
        </p>
    </form>
</div>
