<div>
    @include('component.navbar')
    @include('component.successMessage')
    @section('title', 'Aggiungi articoli | ')

    <div class="mt-10">

        <div class="flex items-center justify-center">
            <main class="w-full min-h-screen py-1 md:w-2/3 lg:w-3/4">
                <div class="p-2 md:p-4">
                    <div class="items-center mt-8 sm:mt-14 text-[#202142]">
                        <p class="text-2xl font-semibold mb-5">Inserisci nuovo articolo</p>
                        <div class="grid grid-cols-1 divide-y">
                            <form wire:submit="addItem">
                                <div class="mb-2 sm:mb-6">
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray">Nome articolo
                                    </label>
                                    <input type="text" wire:model="name"
                                        class="bg-gray-200 border border-gray-600 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                        placeholder="Inserire nome dell'articolo" required>
                                </div>
                                @error('name')
                                    <span>{{ $message }}</span>
                                @enderror

                                <div class="mb-6">
                                    <label for="description"
                                        class="block mb-2 text-sm font-medium text-gray">Descrizione articolo</label>
                                    <textarea rows="4" wire:model="description"
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-200 rounded-lg border border-gray-600"
                                        placeholder="Scrivi qualcosa sull'articolo..."></textarea>
                                </div>
                                @error('description')
                                    <span>{{ $message }}</span>
                                @enderror
                                <div class="mb-2 sm:mb-6">
                                    <label for="price"
                                        class="block mb-2 text-sm font-medium text-gray">Prezzo</label>
                                    <input type="number" step="any" wire:model="price" min="0"
                                        class="bg-gray-200 border border-gray-600 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                        placeholder="Inserire prezzo" required>
                                </div>
                                @error('price')
                                    <span>{{ $message }}</span>
                                @enderror
                                <div class="mb-2 sm:mb-6">
                                    <label for="price"
                                        class="block mb-2 text-sm font-medium text-gray">Quantità disponibile</label>
                                    <input type="number" wire:model="quantity" min="0"
                                        class="bg-gray-200 border border-gray-600 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                        placeholder="Inserire quantità" required>
                                </div>
                                @error('price')
                                    <span>{{ $message }}</span>
                                @enderror
                                <div class="mb-5 mt-2">
                                    <label for="image" class="mr-10 mt-5">Scegli un' immagine</label>
                                    <input wire:model="image" type="file" accept="image/png, image/jpeg"
                                        class="form-control">
                                    @error('image')
                                        <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                    @if ($image)
                                        <img class="rounded w-15 h-15 mt-5 block" src="{{ $image->temporaryUrl() }}">
                                    @endif
                                </div>
                                <div wire:loading wire:target="image">
                                    <span class="text-green-500">Uploading...</span>
                                </div>
                                <div class="flex justify-end">
                                    <button type="submit"
                                        class="text-gray bg-gray-300 border border-black hover:bg-gray-400 focus:ring-4 focus:outline-none focus:ring-gray-600 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                                        Crea articolo
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

</div>
