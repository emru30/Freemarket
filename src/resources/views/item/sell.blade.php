@extends('layouts.app')

@section('title', '商品出品')

@section('content')
<div class="container sell-container">
    <h2>商品の出品</h2>

    <form method="POST" action="{{ route('item.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="section-sell">
            <h3>商品画像</h3>
            <div class="form-group image-upload-box">
                <input type="file" id="image" name="image" accept="image/*" required>

                <label for="image" class="file-label btn-image-select">画像を選択する</label>

                <div id="image-preview" class="image-preview">
                    </div>

                @error('image')
                    <div class="validation-message">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="section-sell">
            <h3>商品の詳細</h3>

            <div class="form-group category-group">
                <label>カテゴリ</label>
                <div class="category-buttons">

                    @php
                        $categories = ['ファッション', '家電', 'インテリア', 'レディース', 'メンズ', 'コスメ', '本', 'ゲーム', 'スポーツ', 'キッチン', 'ハンドメイド', 'アクセサリー', 'おもちゃ', 'ベビー・キッズ'];
                    @endphp

                    @foreach ($categories as $index => $categoryName)
                        <input type="radio" id="cat-{{ $index }}" name="category_id" value="{{ $index + 1 }}" class="category-radio" {{ old('category_id') == $index + 1 ? 'checked' : '' }}>
                        <label for="cat-{{ $index }}" class="category-label">{{ $categoryName }}</label>
                    @endforeach
                </div>
                @error('category_id')<div class="validation-message">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="condition">商品の状態</label>
                <select id="condition" name="condition_id" required>
                    <option value="" disabled selected>選択してください</option>

                    <option value="1">新品、未使用</option>
                    <option value="2">目立った傷や汚れなし</option>
                    <option value="3">やや傷や汚れあり</option>
                    <option value="4">傷や汚れあり</option>
                </select>
                @error('condition_id')<div class="validation-message">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="section-sell">
            <h3>商品名と説明</h3>

            <div class="form-group">
                <label for="name">商品名</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')<div class="validation-message">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="brand">ブランド名</label>
                <input type="text" id="brand" name="brand" value="{{ old('brand') }}">
                @error('brand')<div class="validation-message">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="description">商品の説明</label>
                <textarea id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
                @error('description')<div class="validation-message">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="section-sell">
            <h3>販売価格</h3>
            <div class="form-group price-input-group">
                <span class="price-unit">¥</span>
                <input type="number" id="price" name="price" value="{{ old('price') }}" required min="100" placeholder="0">
                @error('price')<div class="validation-message">{{ $message }}</div>@enderror
            </div>
        </div>

        <button type="submit" class="btn-submit btn-sell-submit">出品する</button>
    </form>
</div>
@endsection