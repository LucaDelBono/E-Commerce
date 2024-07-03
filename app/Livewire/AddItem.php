<?php

namespace App\Livewire;

use App\Models\Item;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddItem extends Component
{
    use WithFileUploads;

    #[Validate('required|min:10|max:100')]
    public $name;

    #[Validate('required|min:50|max:1000')]
    public $description;

    #[Validate('required')]
    public $price;

    #[Validate('required|image')]
    public $image;

    #[Validate('required')]
    public $quantity;

    public function addItem(){
        $validated= $this->validate();

        if($this->image){
            $validated['image']=$this->image->store('itemsImage', 'public');
        }
        Item::create($validated);
        $this->reset(['name', 'description', 'price', 'image', 'quantity']);
        session()->flash('success', 'Articolo aggiunto con successo');
    }

    public function render()
    {
        return view('livewire.add-item')
        ->extends('layout/app')
        ->section('content');
    }
}
