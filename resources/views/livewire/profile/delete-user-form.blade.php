<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component
{
    public string $password = '';

    public function deleteUser(Logout $logout): void
    {
        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        tap(Auth::user(), $logout(...))->delete();

        $this->redirect('/', navigate: true);
    }
}; ?>

<section class="space-y-6">
    <header>
        <!-- MUDANÇA: Estilo do cabeçalho para 'perigo' -->
        <h2 class="text-2xl font-bold text-red-700">
            {{ __('Excluir Conta') }}
        </h2>

        <p class="mt-2 text-gray-600">
            {{ __('Uma vez que sua conta for excluída, todos os seus recursos e dados serão permanentemente apagados. Antes de excluir sua conta, por favor, baixe quaisquer dados ou informações que você deseja manter.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Excluir Conta') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->isNotEmpty()" focusable>
        <form wire:submit="deleteUser" class="p-6">

            <!-- MUDANÇA: Estilo do título do modal -->
            <h2 class="text-lg font-medium text-red-700">
                {{ __('Você tem certeza que quer excluir sua conta?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Uma vez que sua conta for excluída, todos os seus recursos e dados serão permanentemente apagados. Por favor, digite sua senha para confirmar que você gostaria de excluir permanentemente sua conta.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    wire:model="password"
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <!-- MUDANÇA: Cor do anel de foco -->
                <x-secondary-button x-on:click="$dispatch('close')" class="focus:!ring-biblioteca-500">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Excluir Conta') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
