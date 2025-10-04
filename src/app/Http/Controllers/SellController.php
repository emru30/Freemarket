<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SellController extends Controller
{
    public function create()
    {
        return view('item.sell');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|max:2048',
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'condition_id' => 'required|integer',
            'brand' => 'nullable|string|max:255',
            'description' => 'required|string',
            'price' => 'required|integer|min:100',
        ]);

        $image_url = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/items');
            $filename = basename($path);

            $image_url = Storage::url($filename);
        }

        return redirect()->route('item.list')->with('success', '商品を出品しました！');
    }
}