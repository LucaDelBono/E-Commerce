<div>
    <div class="flex items-center justify-between mt-6 ">
        <span class="text-3xl font-bold text-gray-900 dark:text-white">{{ $item->price }} €</span>
        @auth
            @if ($item->quantity <= 0)
                <button wire.attr="disabled"
                    class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Prodotto esaurito</button>
            @else
                <button wire:click="addToCart"
                    class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Aggiungi al carrello</button>
            @endif

        @endauth
        @guest
            @if ($item->quantity <= 0)
                <button wire.attr="disabled"
                    class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Prodotto esaurito</button>
            @else
                <a href="{{ route('login') }}"
                    class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Aggiungi al carrello</a>
            @endif

        @endguest
    </div>
</div>
