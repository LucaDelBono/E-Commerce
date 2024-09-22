@extends('layout.app')
@section('content')
    @include('components.navbar')
    @include('components.successMessage')
    @include('components.errorMessage')
    <div class="flex items-center justify-center">
        <main class="w-full max-w-screen-xl mx-auto py-1 md:w-2/3 lg:w-3/4">
            <div class="p-2 md:p-4">
                <div class="items-center mt-8 sm:mt-14 text-[#202142]">
                    <livewire:item-update :item="$item" />
                    <livewire:item.item-add-images :item="$item" />
                </div>
            </div>
        </main>
    </div>
@endsection
