@extends('layout.app')
@section('content')
    @include('component.navbar')
    @include('component.successMessage')
    @include('component.searchBar')
    <div class="mt-20">
        <main class="container max-w-screen-xl flex flex-grow justify-between mx-auto p-4">
            <div class="grid grid-flow-row grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-10 gap-y-32 w-fit">
                @foreach ($items as $item)
                    <div wire:key="{{$item->id}}" class="md:col-span-1 col-span-4">
                        <div
                            class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <a href="{{route('show', $item->id)}}">
                                <img class="p-8 rounded-t-lg size-96 object-contain" src="{{$item->getImageUrl()}}"
                                    alt="product image" />
                            </a>
                            <div class="px-5 pb-5">
                                <a href="{{route('show', $item->id)}}">
                                    <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                        {{Str::limit($item->name, 50)}}
                                    </h5>
                                </a>
                                
                                <livewire:to-cart :item="$item">
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        </main>
    </div>
@endsection
