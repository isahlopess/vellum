<div 
    x-data="{ show: true }" 
    x-show="show" 
    x-transition 
    class="fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded shadow"
>
    <span>Notificação de exemplo!</span>
    <button class="ml-2 text-sm underline" @click="show = false">Fechar</button>
</div>
