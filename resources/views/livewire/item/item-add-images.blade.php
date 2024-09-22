<div>
    <hr class="mt-3 mb-3">
    @include('components.successMessage')
    <p class="text-2xl font-semibold mb-5">Aggiungi immagini aggiuntive</p>
    <form wire:submit="add">
        <input multiple wire:model="images" type="file" accept="image/png, image/jpeg"
            class="block w-full mb-5 text-sm bg-blue-600 text-white border-gray-800 p-3 rounded-lg cursor-pointer">
        @error('images')
            <span class="text-red-500">{{ $message }}</span>
        @enderror
        @if ($images)
            @foreach ($images as $image)
                <img src="{{ $image->temporaryUrl() }}" class="size-48 mb-2">
            @endforeach

            <div x-data class="flex justify-end">
                <button x-on:click="$dispatch('open-modal', {name : 'add'})" type="button"
                    class="mt-3 text-gray bg-gray-300 border border-black hover:bg-gray-400 focus:ring-4 focus:outline-none focus:ring-gray-600 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                    Salva modifiche
                </button>
                <x-modal name="add" title="Aggiungere le immagini selezionate?">
                    @slot('body')
                        <button type="submit"
                            class="px-4 py-2 font-bold bg-green-500 hover:bg-green-600 text-white rounded">
                            Conferma
                        </button>
                    @endslot
                </x-modal>
            </div>
        @endif
    </form>
    <hr class="mt-3 mb-3">
    <p class="text-2xl font-semibold mb-5">Elimina immagini aggiuntive</p>
    <button wire:click="delete"
        class="w-full bg-red-500 text-white hover:bg-red-400 border border-gray-700 rounded-lg px-5 py-2.5 text-center text-sm sm:w-auto float-right">Elimina
        immagini</button>

</div>
