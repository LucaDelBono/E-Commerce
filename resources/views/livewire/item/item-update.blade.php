<div>
    <p class="text-2xl font-semibold mb-5">Modifica articolo</p>
    <div class="grid grid-cols-1 divide-y">
        <form wire:submit="update" enctype="multipart/form-data">
            <div class="mb-2 sm:mb-6">
                <label for="name" class="block mb-2 text-sm font-medium text-gray">Nome articolo
                </label>
                <input type="text" wire:model="name"
                    class="bg-gray-200 border border-gray-600 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                    placeholder="Inserire nome dell'articolo" required>
                @error('name')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-6">
                <label for="description" class="block mb-2 text-sm font-medium text-gray">Descrizione
                    articolo</label>
                <textarea rows="4" wire:model="description"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-200 rounded-lg border border-gray-600"
                    placeholder="Scrivi qualcosa sull'articolo..."></textarea>
                @error('description')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-2 sm:mb-6">
                <label for="price" class="block mb-2 text-sm font-medium text-gray">Prezzo</label>
                <input type="number" step="any" wire:model="price" min="0"
                    class="bg-gray-200 border border-gray-600 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                    placeholder="Inserire prezzo" required>
                @error('price')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-8">
                <label for="price" class="block mb-2 text-sm font-medium text-gray">Quantità
                    disponibile</label>
                <input type="number" wire:model="quantity" min="0"
                    class="bg-gray-200 border border-gray-600 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                    placeholder="Inserire quantità" required>
                @error('price')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-5 mt-2">
                <label for="image" class="mr-10 mt-5">Scegli un' anteprima</label>
                <input wire:model="image" type="file" accept="image/png, image/jpeg" class="form-control">
                @error('image')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
                @if ($image)
                    <img class="rounded size-72 mt-5 block" src="{{ $image->temporaryUrl() }}">
                @else
                    <img class="rounded size-72 mt-5 block" src="{{ $item->getImageUrl() }}">
                @endif
            </div>
            <div wire:loading wire:target="image">
                <span class="text-green-500">Uploading...</span>
            </div>
            <div x-data class="flex justify-end">
                <button x-on:click="$dispatch('open-modal', {name : 'update'})" type="button"
                    class="text-gray bg-gray-300 border border-black hover:bg-gray-400 focus:ring-4 focus:outline-none focus:ring-gray-600 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                    Salva modifiche
                </button>
                <x-modal name="update" title="Aggiornare articolo?">
                    @slot('body')
                        <button type="submit"
                            class="px-4 py-2 font-bold bg-green-500 hover:bg-green-600 text-white rounded">
                            Conferma
                        </button>
                    @endslot
                </x-modal>
            </div>
        </form>
    </div>
</div>
