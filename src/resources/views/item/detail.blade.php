@extends('layouts.app')

@section('title', '商品詳細')

@section('content')
<div class="container detail-page-container">
    <div class="item-detail-content">
        <div class="detail-left-column">
            <div class="item-image-main-placeholder">
                <span class="image-text">商品画像</span>
            </div>
        </div>

        <div class="detail-right-column">

            <h2 class="item-name-detail">商品名がここに入る</h2>
            <p class="item-brand-detail">ブランド名</p>
            <p class="item-price-detail">¥47,000<span class="tax-info">(税込)</span></p>

            <div class="item-interactions">
                <div class="like-status">
                    <i class="fa-solid fa-star"></i> <span>3</span>
                </div>
                <div class="comment-status">
                    <i class="fa-solid fa-comment"></i> <span>1</span>
                </div>
            </div>

            <a href="{{ route('item.purchase', ['item_id' => 1]) }}" class="btn-purchase-link">購入手続きへ</a>

            <div class="item-description-section">
                <h3>商品説明</h3>
                <div class="description-text">
                    <p>カラー：グレー</p>
                    <p>新品</p>
                    <p>商品の状態は良好です。傷もありません。</p>
                    <p>購入後、即発送いたします。</p>
                </div>
            </div>

            <div class="item-info-section">
                <h3>商品の情報</h3>
                <table class="item-info-table">
                    <tr>
                        <th>カテゴリー</th>
                        <td>
                            <span class="info-tag">洋服</span>
                            <span class="info-tag">メンズ</span>
                        </td>
                    </tr>
                    <tr>
                        <th>商品の状態</th>
                        <td>
                            <span class="info-tag">良好</span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="item-comment-area">
        <h3>コメント(1)</h3>

        <div class="comment-list">
            <div class="comment-item">
                <p class="comment-user">admin</p>
                <div class="comment-text-bubble">
                    こちらにコメントが入ります。
                </div>
            </div>
        </div>

        <div class="comment-form-section">
            <form method="POST" action="{{ route('comment.store', ['item_id' => 1]) }}">
                @csrf
                <h4>商品へのコメント</h4>
                <textarea name="comment" rows="4" placeholder></textarea>
                <button type="submit" class="btn-submit btn-send-comment">コメントを送信する</button>
            </form>
        </div>
    </div>
</div>
@endsection
