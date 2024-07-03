<?php

namespace App\Livewire;

use App\Models\Item;
use App\Models\Cart as ModelsCart;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class Cart extends Component
{
    public $totalPrice = 0;

    public $totalQuantity;


    public function delete(ModelsCart $cartItem)
    {
        $cartItem->delete();
        session()->flash('success', 'Articolo rimosso');
    }

    public function increment(ModelsCart $cartItem)
    {
        $cartItem->quantity += 1;
        $cartItem->save();
    }

    public function decrement(ModelsCart $cartItem)
    {
        if ($cartItem->quantity > 1) {
            $cartItem->quantity -= 1;
            $cartItem->save();
        }
    }

    public function render()
    {
        
        $cartItems = ModelsCart::with('item')
            ->where('user_id', auth()->user()->id)->get();
        return view('livewire.cart', compact('cartItems'))
            ->extends('layout.app')
            ->section('content');
    }
}
