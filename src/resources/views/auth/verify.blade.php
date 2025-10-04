@extends('layouts.app')

@section('title', 'メール認証')

@section('content')
<div class="container verify-container">
    <div class="message-box">
        <p>ご登録していただいたメールアドレスに認証メールを送付しました。</p>
        <p>メール認証を完了してください。</p>
    </div>

    <div class="verification-button-area">
        <button type="button" class="btn-verify-guide">認証はこちらから</button>
    </div>

    <div class="resend-link-area">
        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="link-button">認証メールを再送する</button>
        </form>
    </div>
</div>
@endsection