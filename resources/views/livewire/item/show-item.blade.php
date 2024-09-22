<div>
    @include('components.navbar')
    @include('components.successMessage')
    @section('title', $item->name . ' | ')
    <div class="mt-10 py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="p-4 lg:max-w-7xl max-w-4xl mx-auto">
                <div class="grid items-start grid-cols-1 lg:grid-cols-5 gap-12">
                    <div class="lg:col-span-3 w-full lg:sticky top-0 text-center">

                        <div class="px-4 py-10 rounded-lg shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] relative">
                            @if ($preview)
                                <img src="{{ $preview->getImageUrl() }}" alt="{{ $item->name }}"
                                    class="w-3/4 rounded object-cover mx-auto" />
                            @else
                                <img src="{{ $item->getImageUrl() }}" alt="{{ $item->name }}"
                                    class="w-3/4 rounded object-cover mx-auto" />
                            @endif
                        </div>

                        @if ($images)
                            <div class="mt-6 flex flex-wrap justify-center gap-6 mx-auto">
                                @foreach ($images as $image)
                                    <button wire:click="changeImage({{$image->id}})"
                                        class="w-24 h-20 flex items-center justify-center rounded-lg p-4 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] cursor-pointer">
                                        <img src="{{ $image->getImageUrl() }}" alt="Product2" class="w-full" />
                            </button>
                                @endforeach

                            </div>
                        @endif
                    </div>

                    <div class="lg:col-span-2">
                        <h2 class="text-2xl font-extrabold text-gray-800">{{ $item->name }}</h2>
                        <div class="flex flex-wrap gap-4 mt-8">
                            <p class="text-gray-800 text-3xl font-bold">{{ $item->price }}€</p>
                        </div>
                        <div class="mt-2">
                            <span class="font-bold text-black">Disponibilità:</span>
                            @if($item->quantity > 0)
                            <span class="text-gray-900">In Stock</span>
                            @else
                            <span class="text-gray-900">Non disponibile</span>
                            @endif
                        </div>
                        @if($item->quantity > 0)
                        <div class="flex flex-wrap gap-4 mt-8">
                            @auth
                                <button wire:click="addToCart"
                                    class="min-w-[200px] px-4 py-2.5 border border-gray-600 bg-transparent hover:bg-blue-50 text-black text-sm font-semibold rounded">Aggiungi
                                    al carrello</button>
                            @endauth
                            @guest
                                <button type="button"
                                    class="min-w-[200px] px-4 py-2.5 border border-gray-600 bg-transparent hover:bg-blue-50 text-black text-sm font-semibold rounded">
                                    Accedi per aggiungere al carrello</button>
                            @endguest
                        </div>
                        @endif
                        <h3 class="text-xl mt-5 font-bold text-gray-800">Descrizione</h3>
                        <p>{{ $item->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
