@extends('layouts.app')

@section('title', 'プロフィール編集')

@section('content')
<div class="container profile-edit-container">
    <h2>プロフィール編集</h2>
    <form method="POST" action="{{ route('mypage.profile.edit') }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="form-group profile-image-group">
            <label>プロフィール画像</label>
            <div class="current-icon">
                <img src="https://placehold.co/100x100/f5f5f5/888?text=Icon" alt="現在のアイコン" class="profile-icon">
            </div>
            <div class="image-upload-box small-box">
                <input type="file" id="new_icon" name="new_icon" accept="image/*">
                <label for="new_icon" class="file-label btn-image-select">新しい画像を選択</label>
            </div>
            @error('new_icon')
                <div class="validation-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="name">お名前</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name ?? 'テスト ユーザー') }}" required>
            @error('name')
                <div class="validation-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email ?? 'test@example.com') }}" required>
            @error('email')
                <div class="validation-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">パスワード</label>
            <input type="password" id="password" name="password" placeholder="新しいパスワード">
            @error('password')
                <div class="validation-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">パスワード（確認用）</label>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="新しいパスワードを再入力">
        </div>

        <button type="submit" class="btn-submit btn-profile-update">更新する</button>
    </form>
</div>
@endsection