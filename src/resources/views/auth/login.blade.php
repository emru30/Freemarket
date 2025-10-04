@extends('layouts.app')

@section('title', 'ログイン')

@section('content')
<div class="container form-container">
    <h2>ログイン</h2>
    <form method="POST" action="{{ route('login.process') }}">
        @csrf

        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
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

        <button type="submit" class="btn-submit">ログインする</button>
    </form>

    <div class="link-to-register">
        <a href="{{ route('register') }}">会員登録はこちら</a>
    </div>
</div>
@endsection