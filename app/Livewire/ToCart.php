<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Item;
use Livewire\Component;

class ToCart extends Component
{
    public Item $item;

    public function addToCart()
    {
        $user= auth()->user()->id;
        Cart::create([
            'user_id'=>$user,
            'item_id'=>$this->item->id
        ]);
        return redirect()->route('index')->with('success', 'Articolo aggiunto al carrello');
    }

    public function render()
    {
        $item = $this->item;
        return view('livewire.to-cart', compact('item'));
    }
}
