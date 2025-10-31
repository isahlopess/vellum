<x-layouts.menu :title="__('Meu Perfil')">
    <div>
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-2xl overflow-hidden divide-y divide-biblioteca-200">

                <div class="p-6 sm:p-8">
                    <div class="max-w-xl mx-auto">
                        <livewire:profile.update-profile-information-form />
                    </div>
                </div>

                <div class="p-6 sm:p-8">
                    <div class="max-w-xl mx-auto">
                        <livewire:profile.update-password-form />
                    </div>
                </div>

                <div class="p-6 sm:p-8">
                    <div class="max-w-xl mx-auto">
                        <livewire:profile.delete-user-form />
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layouts.menu>
