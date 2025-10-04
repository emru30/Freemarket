@extends('layouts.app')

@section('title', '会員登録')

@section('content')
<div class="container form-container">
    <h2>会員登録</h2>
    <form method="POST" action="{{ route('register.process') }}">
        @csrf

        <div class="form-group">
            <label for="name">お名前</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
            @error('name')
                <div class="validation-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="validation-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">パスワード</label>
            <input type="password" id="password" name="password" required>
            @error('password')
                <div class="validation-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password-confirm">パスワード（確認用）</label>
            <input type="password" id="password-confirm" name="password_confirmation" required>
            @error('password_confirmation')
                <div class="validation-message">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn-submit">登録</button>
    </form>

    <div class="link-to-login">
        <a href="{{ route('login') }}">ログインはこちら</a>
    </div>
</div>
@endsection