<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;
use Livewire\WithFileUploads; // <-- 1. ADICIONAR IMPORT
use Illuminate\Support\Facades\Storage; // <-- Importar Storage

new class extends Component
{
    use WithFileUploads; // <-- 2. USAR O TRAIT

    public string $name = '';
    public string $email = '';
    public $photo; // <-- 3. ADICIONAR PROPRIEDADE DA FOTO

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        // 4. ATUALIZAR VALIDAÇÃO
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'photo' => ['nullable', 'image', 'max:1024'], // Validar a foto (1MB max)
        ]);

        // 5. PROCESSAR A FOTO (SE HOUVER)
        if ($this->photo) {
            // Se já existir uma foto antiga, apaga ela
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }
            // Salva a nova foto em 'storage/app/public/profile-photos'
            $validated['profile_photo_path'] = $this->photo->store('profile-photos', 'public');
        }

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // Limpa o input da foto após salvar
        $this->photo = null;

        $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));
            return;
        }

        $user->sendEmailVerificationNotification();
        Session::flash('status', 'verification-link-sent');
    }
}; ?>

    <!--
  MUDANÇA:
  Usamos x-data do Alpine para gerenciar o clique no input de arquivo
-->
<section x-data="{ photoName: null, photoPreview: null }">
    <!--
      NOVO BLOCO: Seção de Upload da Foto
    -->
    <div class="flex items-center gap-6">
        <!-- Avatar Atual / Preview -->
        <div>
            <span class="block h-20 w-20 rounded-full bg-biblioteca-100 overflow-hidden">
                @if ($photo)
                    <!-- Preview da Nova Foto -->
                    <img src="{{ $photo->temporaryUrl() }}" class="h-full w-full object-cover">
                @elseif (Auth::user()->profile_photo_path)
                    <!-- Foto Atual Salva -->
                    <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" alt="{{ $name }}" class="h-full w-full object-cover">
                @else
                    <!-- Avatar Padrão (Ícone) -->
                    <svg class="h-full w-full text-biblioteca-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                @endif
            </span>
        </div>

        <!-- Botões de Upload -->
        <div>
            <!-- Input de arquivo real (escondido) -->
            <input type="file" class="hidden"
                   wire:model="photo"
                   id="photo-input-{{ $this->getId() }}">

            <!-- Botão "Selecionar Foto" que clica no input escondido -->
            <x-secondary-button
                x-on:click.prevent="document.getElementById('photo-input-{{ $this->getId() }}').click()"
                class="focus:!ring-biblioteca-500">
                {{ __('Selecionar Nova Foto') }}
            </x-secondary-button>

            <!-- Indicador de carregamento do Livewire -->
            <div wire:loading wire:target="photo" class="text-sm text-biblioteca-600 mt-1">
                Carregando...
            </div>

            <x-input-error class="mt-2" :messages="$errors->get('photo')" />
        </div>
    </div>

    <!--
      Formulário de Informações (agora abaixo da foto)
    -->
    <header class="mt-6 border-t border-biblioteca-200 pt-6">
        <h2 class="text-2xl font-bold text-biblioteca-800">
            {{ __('Informações do Perfil') }}
        </h2>
        <p class="mt-2 text-biblioteca-600">
            {{ __("Atualize as informações do seu perfil e endereço de e-mail.") }}
        </p>
    </header>

    <form wire:submit="updateProfileInformation" class="mt-6 space-y-6">
        <div>
            <x-input-label for="name" :value="__('Nome')" />
            <x-text-input wire:model="name" id="name" name="name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" name="email" type="email" class="mt-1 block w-full" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Seu e-mail não foi verificado.') }}
                        <button wire:click.prevent="sendVerification" class="underline text-sm text-biblioteca-600 hover:text-biblioteca-800 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-biblioteca-500">
                            {{ __('Clique aqui para reenviar o e-mail de verificação.') }}
                        </button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Um novo link de verificação foi enviado para o seu e-mail.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="!bg-biblioteca-700 hover:!bg-biblioteca-800 focus:!bg-biblioteca-800 focus:!ring-biblioteca-500">
                {{ __('Salvar') }}
            </x-primary-button>

            <x-action-message class="me-3" on="profile-updated">
                {{ __('Salvo.') }}
            </x-action-message>
        </div>
    </form>
</section>

