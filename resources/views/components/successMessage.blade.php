@if (session()->has('success'))
    <div wire:key="{{rand()}}" x-data= "{show : true}" x-effect="setTimeout(()=> show = false, 5000)" x-show="show"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-400"
        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
        <div class="max-w-screen-xl mx-auto flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 bg-green-50"
            role="alert">
            <span class="sr-only">Info</span>
            <div>
                <p class="font-medium">{{ session('success') }}.</p>
            </div>
        </div>
    </div>
@endif
