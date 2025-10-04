<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Item;
use App\Models\Favorite;
use App\Models\Comment;

class ItemController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     */
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'recommended');
        $user = Auth::user();
        $items = collect();

        if ($tab === 'mylist' && $user) {
            $favoriteItems = $user->favorites()->with('item')->get();
            $items = $favoriteItems->map(fn($f) => $f->item);
        } else {
            $items = Item::with(['category', 'condition', 'favorites'])->paginate(15);
        }

        if ($user) {
            $userFavorites = $user->favorites->pluck('item_id')->toArray();

            $items->each(function($item) use ($userFavorites) {
                $item->is_liked = in_array($item->id, $userFavorites);
                $item->likes_count = $item->favorites->count();
            });
        } else {
            $items->each(function($item) {
                $item->likes_count = $item->favorites->count();
            });
        }

        return view('item.list', [
            'items' => $items,
            'tab' => $tab,
            'isLoggedIn' => Auth::check(),
        ]);
    }

    /**
     * @param int $item_id
     */
    public function show($item_id)
    {
        $item = Item::with(['user', 'category', 'condition', 'favorites', 'comments'])
                    ->findOrFail($item_id);

        $user = Auth::user();

        $comments = $item->comments()->with('user')->get();

        $item->likes_count = $item->favorites->count();
        $item->is_liked = $user ? $item->favorites->where('user_id', $user->id)->isNotEmpty() : false;

        return view('item.detail', [
            'item' => $item,
            'comments' => $comments,
            'isLoggedIn' => Auth::check(),
        ]);
    }
}