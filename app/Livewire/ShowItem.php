<?php

namespace App\Livewire;

use App\Models\Cart;
use Livewire\Component;
use App\Models\Item;

class ShowItem extends Component
{
    public Item $item;

    public function addToCart()
    {
        $user= auth()->user()->id;
        Cart::create([
            'user_id'=>$user,
            'item_id'=>$this->item->id
        ]);
        return session()->flash('success', 'Articolo aggiunto al carrello');
    }

    public function render()
    {
        $item = $this->item;
        return view('livewire.item.show-item',compact('item'))
        ->extends('layout.app')
        ->section('content');
    }
}
