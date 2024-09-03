<div>
    @include('components.navbar')
    @include('components.successMessage')
    @section('title', $item->name.' | ')
    <div class="mt-20 py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row -mx-4">
                <div class="md:flex-1 px-4">
                    <div class="h-[460px] rounded-lg bg-gray-300 dark:bg-gray-700 mb-4">
                        <img class="w-full h-full object-cover"
                            src="{{$item->getImageUrl()}}"
                            alt="Product Image">
                    </div>
                    <div class="flex -mx-2 mb-4">
                        <div class="w-1/2 px-2">
                            
                        </div>
                        @auth     
                        <div class="w-1/2 px-2">
                            <button wire:click="addToCart"
                                class="w-full bg-gray-700 text-white py-2 px-4 rounded-full font-bold hover:bg-gray-300 dark:hover:bg-gray-600">
                                Aggiungi al carrello</button>
                        </div>
                        @endauth
                        @guest
                        <div class="w-1/2 px-2">
                            <a href="{{route('login')}}" 
                                class="w-full bg-gray-700 text-white py-2 px-4 rounded-full font-bold hover:bg-gray-300 dark:hover:bg-gray-600">
                                Aggiungi al carrello</a>
                        </div>
                        @endguest
                    </div>
                </div>
                <div class="md:flex-1 px-4">
                    <h2 class="text-2xl font-bold text-black  mb-2">{{$item->name}}</h2>
                    <div class="flex mb-4">
                        <div class="mr-4">
                            <span class="font-bold text-black">Prezzo:</span>
                            <span class="text-gray-900">{{$item->price}}€</span>
                        </div>
                        <div>
                            <span class="font-bold text-black">Disponibilità:</span>
                            <span class="text-gray-900">In Stock</span>
                        </div>
                    </div>
                   
                    
                    <div>
                        <span class="font-bold text-black">Descrizione:</span>
                        <p class="text-gray-900 text-sm mt-2">
                            {{$item->description}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
