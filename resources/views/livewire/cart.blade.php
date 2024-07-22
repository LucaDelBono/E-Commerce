<div>
    @include('components.navbar')
    @include('components.successMessage')
    @include('components.errorMessage')
    @section('title', 'Carrello | ')

    <section class="py-8 antialiased md:py-16">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <h2 class="text-xl font-semibold text-gray-900 sm:text-2xl">Carrello</h2>
            <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
                <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
                    <div class="space-y-6">
                        @foreach ($cartItems as $cartItem)
                            <div wire:key="{{ $cartItem->id }}"
                                class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm  md:p-6">
                                <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                                    <a href="#" class="shrink-0 md:order-1">
                                        <img class="h-20 w-20"
                                            src="{{ $cartItem->item->getImageUrl()}}"/>

                                    </a>
                                    <label for="counter-input" class="sr-only">Scegli quantità:</label>
                                    <div class="flex items-center justify-between md:order-3 md:justify-end">
                                        <div class="flex items-center">
                                            <button type="button" wire:click="decrement({{ $cartItem->id }})"
                                                class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-600 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100">
                                                <svg class="h-2.5 w-2.5 text-gray-900" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 18 2">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                                </svg>
                                            </button>
                                            <input type="text"
                                                class="w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0"
                                                placeholder="" value="{{ $cartItem->quantity }}" required />
                                            <button type="button" wire:click="increment({{ $cartItem->id }})"
                                                class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-600 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100">
                                                <svg class="h-2.5 w-2.5 text-gray-900 " aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 18 18">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="text-end md:order-4 md:w-32">
                                            <p class="text-base font-bold text-gray-900">{{ $cartItem->item->price }}€
                                            </p>
                                        </div>
                                    </div>

                                    <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                                        <a href="#" wire:model="name"
                                            class="text-base font-medium text-gray-900 hover:underline">
                                            {{ $cartItem->item->name }}
                                        </a>

                                        <div class="flex items-center">
                                            <button type="button" wire:click="delete({{ $cartItem->id }})"
                                                class="inline-flex items-center text-sm font-medium text-red-600 hover:underline dark:text-red-500">
                                                <svg class="me-1.5 h-5 w-5" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18 17.94 6M18 18 6.06 6" />
                                                </svg>
                                                Rimuovi
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php
                                $totalPrice += $cartItem->item->price * $cartItem->quantity;
                                $totalQuantity += $cartItem->quantity;
                            @endphp
                        @endforeach
                        <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">
                            <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm sm:p-6">
                                <p class="text-xl font-semibold text-gray-900">Totale provvisorio({{$totalQuantity}} articoli)</p>
                                <div class="space-y-4">
                                    <div class="space-y-2">
                                        <dl class="flex items-center justify-between gap-4">
                                            <dt class="text-base font-normal text-gray-500">Prezzo</dt>
                                            <dd class="text-base font-medium text-gray-900">{{ $totalPrice }} €</dd>
                                        </dl>
                                    </div>
                                    <form action="{{ route('paypal') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="totalPrice" value="{{ $totalPrice }}"
                                            class="text-base font-medium text-gray-900">
                                        <button type="submit"
                                            class="flex w-full items-center justify-center rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-500 focus:outline-none focus:ring-4 focus:ring-primary-300">
                                            Paga con Paypal
                                        </button>
                                    </form>
                                    <form action="{{route('stripe')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="totalPrice" value="{{ $totalPrice }}">
                                    <button 
                                        class="flex w-full items-center justify-center rounded-lg bg-gray-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-gray-500 focus:outline-none focus:ring-4 focus:ring-primary-300">
                                        Paga con carta di credito
                                    </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
    </section>
</div>
