<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $items= Item::search($request->search)->orderBy('created_at','DESC')->get();
        return view('welcome', compact('items'));
    }
}
