@props(['title', 'name'])
<div
    x-data= "{show : false, name : '{{$name}}'}"
    x-show= "show"
    x-on:open-modal.window= "show = ($event.detail.name === name)"
    x-on:close-modal.window= "show = false"
    x-on:keydown.escape.window= "show = false"
    class="fixed z-50 inset-0"
    style="display: none"
    x-transition>
    

    <div x-on:click="show = false" class="fixed inset-0 bg-gray-300 opacity-50"></div>
    <div class="bg-white rounded m-auto fixed inset-0 max-w-xl h-40">
        @if(isset($title))
        <div class="py-3 text-black flex items-center justify-center text-lg mb-5">
            {{ $title }}
        </div>
        @endif
        <div class="flex items-center justify-center gap-4">
            {{$body}}
            <button x-on:click="$dispatch('close-modal')" type="button" class="bg-red-500 hover:bg-red-400 px-4 py-2 text-gray-900 rounded font-bold">Annulla</button>
        </div>
    </div>
</div>