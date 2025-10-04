@extends('layouts.app')

@section('title', '商品一覧')

@section('content')
<div class="container list-container">

    <div class="tabs">
        <a href="{{ route('item.list') }}" class="tab-link {{ request()->query('tab') !== 'mylist' ? 'active' : '' }}">おすすめ</a>

        @auth
        <a href="{{ route('item.list', ['tab' => 'mylist']) }}" class="tab-link {{ request()->query('tab') === 'mylist' ? 'active' : '' }}">マイリスト</a>
        @endauth
    </div>

    <div class="item-grid">
        @php
            $dummyItems = [
                ['id' => 1, 'name' => '商品名1', 'price' => 47000, 'likes' => 3],
                ['id' => 2, 'name' => '商品名2', 'price' => 2500, 'likes' => 1],
                ['id' => 3, 'name' => '商品名3', 'price' => 10000, 'likes' => 5],
                ['id' => 4, 'name' => '商品名4', 'price' => 1500, 'likes' => 0],
                ['id' => 5, 'name' => '商品名5', 'price' => 80000, 'likes' => 2],
                ['id' => 6, 'name' => '商品名6', 'price' => 500, 'likes' => 10],
            ];
        @endphp

        @foreach ($dummyItems as $item)
            <div class="item-card">

                <a href="{{ route('item.detail', ['item_id' => $item['id']]) }}" class="item-image-link">
                    <div class="item-image-placeholder">
                        <span class="image-text">商品画像</span>
                    </div>
                </a>

                <div class="item-info">
                    <div class="item-price">
                        ¥{{ number_format($item['price']) }} (税込)
                    </div>
                    <div class="item-likes">
                        <i class="fa-solid fa-star"></i>
                        <span class="like-count">{{ $item['likes'] }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
