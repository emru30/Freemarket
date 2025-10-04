<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Address;
use App\Models\Purchase;

class PurchaseController extends Controller
{
    public function showPurchase(string $item_id)
    {
        $user = Auth::user();
        $item = Item::findOrFail($item_id);
        $address = $user->address ?? null;

        $paymentMethod = 'クレジットカード';
        return view('item.purchase', compact('item', 'address', 'paymentMethod'));
    }

    public function showAddressChange(string $item_id)
    {
        $user = Auth::user();
        $item = Item::findOrFail($item_id);
        $address = $user->address ?? new Address();

        return view('purchase.address_change', compact('item_id', 'address'));
    }

    public function updateAddress(Request $request, string $item_id)
    {
        $user = Auth::user();
        $validated = $request->validate([
            'post_code' => 'required|string|regex:/^\d{3}-?\d{4}$/',
            'address' => 'required|string|max:255',
            'building' => 'nullable|string|max:255',
        ]);

        Address::updateOrCreate(
            ['user_id' => $user->id],
            $validated
        );

        return redirect()->route('item.purchase', ['item_id' => $item_id])->with('success', '配送先住所を更新しました。');
    }

    public function processPurchase(Request $request, string $item_id)
    {
        $user = Auth::user();
        $item = Item::findOrFail($item_id);
        $addressSnapshot = $user->address ? json_encode($user->address->toArray()) : null;

        Purchase::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
            'address_snapshot' => $addressSnapshot,
        ]);

        return redirect()->route('item.list')->with('success', $item->name . 'の購入が完了しました！');
    }
}