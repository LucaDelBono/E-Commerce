<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Image;
use Livewire\Component;
use App\Models\Item;

class ShowItem extends Component
{
    public Item $item;

    public $preview;

    public function changeImage(Image $image)
    {
        $this->preview = $image;
    }
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
        $images= Image::where('item_id', $this->item->id)->get();
        return view('livewire.item.show-item',compact(['item','images']))
        ->extends('layout.app')
        ->section('content');
    }
}
