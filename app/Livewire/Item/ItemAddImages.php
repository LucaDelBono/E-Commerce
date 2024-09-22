<?php

namespace App\Livewire\Item;

use App\Models\Image;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class ItemAddImages extends Component
{
    use WithFileUploads;

    #[Rule(['images.*' => 'image|max:2048'])]
    public $images;

    public $item;

    public function add()
    {
        $this->validate();
        if ($this->images) {
            foreach ($this->images as $image) {
                Image::create([
                    'item_id' => $this->item->id,
                    'path' => $image->store('itemImages', 'public')
                ]);
            }
            $this->reset('images');
            return session()->flash('success', 'Immagini aggiunte con successo!');
        }
    }

    public function delete()
    {
        DB::table('images')->where('item_id', $this->item->id)->delete();
        session()->flash('success', 'Immagini eliminate con successo!');
    }
    public function render()
    {
        return view('livewire.item.item-add-images');
    }
}
