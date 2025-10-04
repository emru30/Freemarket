@extends('layouts.app')

@section('title', 'マイページ')

@section('content')
<div class="container mypage-container">
    <div class="profile-header">
        <div class="profile-icon-wrapper">
            <img src="https://placehold.co/100x100/f5f5f5/888?text=Icon" alt="ユーザーアイコン" class="profile-icon">
        </div>

        <h2 class="profile-name">{{ $user->name ?? 'テスト ユーザー' }}</h2>
        <div class="profile-actions">
            <a href="{{ route('mypage.profile.edit') }}" class="btn-edit link-button">
                プロフィールを編集する
            </a>
        </div>
    </div>

    <div class="mypage-tabs">
        <a href="{{ route('mypage', ['page' => 'buy']) }}" class="tab-link {{ ($tab ?? 'buy') === 'buy' ? 'active' : '' }}">
            購入した商品
        </a>
        <a href="{{ route('mypage', ['page' => 'sell']) }}" class="tab-link {{ ($tab ?? 'buy') === 'sell' ? 'active' : '' }}">
            出品した商品
        </a>
    </div>

    <div class="item-grid">
        @forelse ($items ?? [] as $item)
            <div class="item-card">
                <a href="{{ route('item.detail', ['item_id' => $item->id]) }}" class="item-image-link">
                    <div class="item-image-placeholder">
                        <span class="image-text">商品画像</span>
                    </div>
                </a>
                <div class="item-info">
                    <p class="item-price">¥{{ number_format($item->price) }}</p>
                    <div class="item-likes">
                        <i class="fas fa-heart"></i> 10
                    </div>
                </div>
            </div>
        @empty
            <p class="no-items-message">
                @if (($tab ?? 'buy') === 'buy')
                    購入した商品はありません。
                @else
                    出品した商品はありません。
                @endif
            </p>
        @endforelse
    </div>
</div>
@endsection