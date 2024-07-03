<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class Orders extends Component
{

    public function render()
    {
        //$this->orders= Order::where('user_id', auth()->user()->id)
        //->get();
        
        return view('livewire.orders', [
            'orders' => Order::with('item')->where('user_id', auth()->user()->id)->latest()->paginate(5)
        ])
        ->extends('layout.app')
        ->section('content');
    }
}
