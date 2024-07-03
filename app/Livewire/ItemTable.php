<?php

namespace App\Livewire;
use App\Models\Item;

use Livewire\Component;
use Livewire\WithPagination;

class ItemTable extends Component
{
    use WithPagination;
    public $paginate;

    public $search='';

    public function delete(Item $item)
    {
        $this->authorize('admin');
        $item->delete();
        session()->flash('success', 'Articolo eliminato con successo');
    }

    public function render()
    {
        $items= Item::search($this->search)->paginate($this->paginate);
        return view('livewire.item-table',compact('items'))
        ->extends('layout.app')
        ->section('content');
    }
}
