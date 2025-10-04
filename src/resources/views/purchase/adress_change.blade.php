@extends('layouts.app')

@section('title', '送付先住所変更')

@section('content')
<div class="container address-change-container">
    <h2>送付先住所変更</h2>

    <form method="POST" action="{{ route('purchase.address.change', ['item_id' => 1]) }}" class="address-form">
        @csrf
        <div class="form-group">
            <label for="postcode">郵便番号</label>
            <input type="text" id="postcode" name="postcode" value="{{ old('postcode') }}" placeholder="例: 1000001" required>
            @error('postcode')
                <div class="validation-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="address">住所</label>
            <input type="text" id="address" name="address" value="{{ old('address') }}" placeholder="例: 東京都千代田区千代田1-1" required>
            @error('address')
                <div class="validation-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="building">建物名</label>
            <input type="text" id="building" name="building" value="{{ old('building') }}" placeholder="任意">
            @error('building')
                <div class="validation-message">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn-submit btn-update-address">更新する</button>
    </form>
</div>
@endsection