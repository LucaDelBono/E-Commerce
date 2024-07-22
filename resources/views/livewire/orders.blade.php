<div>
    @include('components.navbar')
    @include('components.successMessage')
    @include('components.errorMessage')
    @section('title', 'Ordini | ')

    <section class="py-8 antialiased md:py-16">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <h2 class="text-xl font-semibold text-gray-900 sm:text-2xl">Ordini</h2>

            <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
                <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
                    <div class="space-y-6">
                        @foreach ($orders as $order)
                            <div wire:key="{{ $order->id }}"
                                class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm  md:p-6">
                                <span class="mr-3">ID: {{$order->id}}</span>
                                <span class="mr-3">Ordine effettuato il: {{\Carbon\Carbon::parse($order->created_at)->format('d/m/y')}}</span>
                                <span>Totale: {{$order->amount}}</span>

                                <div class="mt-4 space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                                    <a href="#" class="shrink-0 md:order-1">
                                        <img class="h-20 w-20"
                                            src="{{$order->item->getImageUrl()}}"/>

                                    </a>
                                    <div class="text-end md:order-3 md:w-32">
                                        <a href="" class="text-base font-medium text-gray-900 hover:underline">Dettagli ordine
                                        </a>
                                    </div>

                                    <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 ">
                                        <a href="#" 
                                            class="text-base font-medium text-gray-900 hover:underline">
                                            {{ $order->item->name }}
                                        </a>
                                        
                                    </div>
                                </div>
                            </div>
                        @endforeach      
                    </div>
                    <div class="mt-3">{{$orders->links()}}</div>
    </section>
</div>
