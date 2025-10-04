<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <div class="header-inner container">
            <div class="header-left">
                <h1>
                    <a href="{{ route('item.list') }}">
                        <img src="{{ asset('img/logo.svg') }}" class="header-logo">
                    </a>
                </h1>
            </div>

            <div class="header-center">
                <form action="{{ route('item.list') }}" method="GET" class="search-form">
                    <input type="search" name="keyword" placeholder="なにをお探しですか？">
                    <button type="submit" style="display: none;"></button>
                </form>
            </div>

            <nav class="header-right">
                @auth
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="nav-link">ログアウト</button>
                    </form>
                    <a href="{{ route('mypage') }}" class="nav-link">マイページ</a>
                    <a href="{{ route('item.sell') }}" class="btn-sell nav-link">出品</a>
                @else
                    <a href="{{ route('login') }}" class="nav-link">ログイン</a>
                    <a href="{{ route('item.list') }}" class="nav-link">マイページ</a>
                @endauth
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="container">
            <p>&copy; COACHTECH All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>