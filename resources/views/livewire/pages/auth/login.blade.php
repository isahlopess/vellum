<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    public function login()
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        return redirect()->route('dashboard');
    }
}; ?>

<div>
    <div class="text-center">
        <img class="mx-auto h-20 w-auto" src="{{ asset('imagens/logo_icon.png') }}" alt="Vellum Logo">
        <h2 class="mt-6 text-3xl font-bold text-biblioteca-800">
            Acesse sua conta
        </h2>
        <p class="mt-2 text-sm text-gray-600">
            Bem-vindo de volta à Biblioteca Vellum!
        </p>
    </div>

    <form wire:submit="login" class="mt-8 space-y-6">

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-sm font-bold text-gray-700 tracking-wide" />
            <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full" type="email" name="email" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-sm font-bold text-gray-700 tracking-wide" />
            <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <div class="block">
                <label for="remember" class="inline-flex items-center">
                    <input wire:model="form.remember" id="remember" type="checkbox" class="rounded border-gray-300 text-biblioteca-600 shadow-sm focus:ring-biblioteca-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Lembrar de mim') }}</span>
                </label>
            </div>
            <div class="text-sm">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-biblioteca-700 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-biblioteca-500" href="{{ route('password.request') }}" wire:navigate>
                        {{ __('Esqueceu sua senha?') }}
                    </a>
                @endif
            </div>
        </div>

        <div class="mt-6">
            <button type="submit"
                    class="w-full flex justify-center bg-biblioteca-700 text-white p-3 rounded-lg font-semibold tracking-wide
                           focus:outline-none focus:shadow-outline hover:bg-biblioteca-800 shadow-lg
                           cursor-pointer transition ease-in duration-300">
                {{ __('Entrar') }}
            </button>
        </div>

        <p class="flex flex-col items-center justify-center mt-6 text-center text-md text-gray-500">
            <span>Não tem uma conta?</span>
            <a href="{{ route('register') }}" class="text-biblioteca-700 hover:text-biblioteca-800 no-underline hover:underline cursor-pointer transition ease-in duration-300" wire:navigate>
                Cadastre-se
            </a>
        </p>
    </form>
</div>
