@extends('layouts.app')
@section('title', '商品購入')
@section('content')
    <div class="purchase-container">
        <div class="item-summary">

        </div>

        <div class="order-details">
            <form action="{{ route('item.purchase', ['item_id' => $item->id]) }}" method="POST">
                @csrf
                <h3>支払い方法</h3>
                <select name="payment_method">
                    <option value="">選択してください</option>
                    <option value="credit_card">クレジットカード</option>
                    <option value="convenience_store">コンビニ払い</option>
                </select>

                <h3>配送先</h3>
                <div class="shipping-info">
                    <p>〒XXX-YYYY ここには住所と建物名が入ります</p>
                    <a href="{{ route('purchase.address.change', ['item_id' => $item->id]) }}" class="btn-change">変更する</a>
                </div>

                <div class="purchase-price-summary">

                </div>

                <button type="submit" class="btn-purchase">購入する</button>
            </form>
        </div>
    </div>
@endsection