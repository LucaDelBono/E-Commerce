<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function edit(Item $item)
    {
        return view('item.edit-item', compact('item'));
    }
}
