<div>
    @include('components.navbar')
    @include('components.successMessage')
    @section('title', 'Articoli | ')

    <section class="mt-10">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <p class="text-2xl font-semibold mb-5">Tabella articoli</p>
            <div class="bg-white  relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex items-center justify-between d p-4">
                    <div class="flex">
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 " fill="currentColor"
                                    viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" wire:model.live.debounce.300ms="search"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 "
                                placeholder="Search">
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3">ID</th>
                                <th scope="col" class="px-4 py-3">Nome</th>
                                <th scope="col" class="px-4 py-3">Descrizione</th>
                                <th scope="col" class="px-4 py-3">Quantità</th>
                                <th scope="col" class="px-4 py-3">Prezzo</th>
                                <th scope="col" class="px-4 py-3">Data creazione</th>
                                <th scope="col" class="px-4 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr wire:key="{{ $item->id }}" class="border-b">
                                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $item->id }}</th>
                                    <td class="px-4 py-3">{{ $item->name }}</td>
                                    <td class="px-4 py-3 text-green-500">
                                        {{ Str::limit($item->description, 50) }}</td>
                                    <td class="px-4 py-3">{{ $item->quantity }}</td>
                                    <td class="px-4 py-3">{{ $item->price }}</td>
                                    <td class="px-4 py-3">
                                        {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/y') }}</td>
                                    <td x-data class="px-4 py-3 flex items-center justify-end">
                                        <button x-on:click="$dispatch('open-modal', {name : 'delete'})"
                                            class="px-3 py-1 bg-red-500 text-white rounded">X</button>
                                        <x-modal name="delete" title="Eliminare definitivamente l'articolo?">
                                            @slot('body')
                                                <button type="submit" wire:click="delete({{ $item->id }})"
                                                    class="px-4 py-2 font-bold bg-green-500 hover:bg-green-600 text-white rounded">Conferma</button>
                                            @endslot
                                        </x-modal>

                                        <a href="{{ route('edit', $item->id) }}"
                                            class="ml-5 px-3 py-1 bg-blue-500 text-white rounded">Modifica</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="py-4 px-3">
                    <div class="flex ">
                        <div class="flex space-x-4 items-center mb-3">
                            <label class="w-32 text-sm font-medium text-gray-900">Per Page</label>
                            <select wire:model.live="paginate"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="75">75</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                    {{ $items->links() }}
                </div>
            </div>
        </div>
    </section>
</div>
