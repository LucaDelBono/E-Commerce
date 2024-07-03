<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\Item;
use Livewire\WithFileUploads;

class ItemUpdate extends Component
{
    use WithFileUploads;

    public Item $item;

    #[Validate('required|min:10|max:100')]
    public $name;

    #[Validate('required|min:50|max:1000')]
    public $description;

    #[Validate('required')]
    public $price;

    #[Validate('nullable|image')]
    public $image;

    #[Validate('required')]
    public $quantity;

    public function update()
    {
        $this->authorize('admin');
        $validated = $this->validate();
        if ($this->image) {
            $this->validateOnly('image');
            $validated['image'] = $this->image->store('itemsImage', 'public');
            $this->item->update($validated);
        } else {
            $this->item->update([
                'name' => $this->name,
                'quantity' => $this->quantity,
                'price' => $this->price,
                'description' => $this->description,
            ]);
        }
        $this->reset('image');
        session()->flash('success', 'Articolo aggiornato con successo');
    }

    public function render()
    {
        $this->name = $this->item->name;
        $this->description = $this->item->description;
        $this->price = $this->item->price;
        $this->quantity = $this->item->quantity;

        $item = $this->item;
        return view('livewire.item-update', compact('item'))
            ->extends('layout.app')
            ->section('content');
    }
}
