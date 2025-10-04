<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Profile;
use App\Models\Address;

class UserController extends Controller
{
    public function showProfile(Request $request)
    {
        $user = Auth::user();
        $profile = $user->profile ?? new Profile();
        $page = $request->query('page', 'sell');

        $items = collect();
        if ($page === 'buy') {
            $items = $user->purchases()->with('item.favorites')->get()->pluck('item');
        } else {
            $items = $user->items()->with('favorites')->get();
        }

        $items->each(function($item) use ($user) {
            $item->likes_count = $item->favorites->count();
            $item->is_liked = $user ? $item->favorites->where('user_id', $user->id)->isNotEmpty() : false;
        });

        return view('user.profile', [
            'user' => $user,
            'profile' => $profile,
            'items' => $items,
            'page' => $page,
        ]);
    }

    public function editProfile()
    {
        $user = Auth::user();
        $profile = $user->profile ?? new Profile();
        $address = $user->address ?? new Address();
        return view('user.profile_edit', compact('user', 'profile', 'address'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'post_code' => 'required|string|regex:/^\d{3}-?\d{4}$/',
            'address' => 'required|string|max:255',
            'building' => 'nullable|string|max:255',
        ]);

        $user->name = $validated['name'];
        $user->save();

        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'post_code' => $validated['post_code'],
                'address' => $validated['address'],
                'building' => $validated['building'],
            ]
        );

        $user->address()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'post_code' => $validated['post_code'],
                'address' => $validated['address'],
                'building' => $validated['building'],
            ]
        );

        return redirect()->route('mypage')->with('success', 'プロフィールを更新しました。');
    }
}