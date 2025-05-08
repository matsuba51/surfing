<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>サーフィン情報サイト</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;600&display=swap" rel="stylesheet">
    <!-- 以下、Bootstrap 5　関連 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand title fs-4	" href="{{ url('/') }}">サーフィン情報サイト</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item fs-5">
                            <a class="nav-link" href="{{ route('register') }}">新規登録</a>
                        </li>
                        <li class="nav-item fs-5">
                            <a class="nav-link" href="{{ route('login') }}">ログイン</a>
                        </li>
                    @else
                            <!-- 管理者メニュー -->
                            @if (Auth::user()->isAdmin())
                                <a class="fs-5 text-decoration-none text-dark control" href="{{ route('admin.dashboard') }}">管理画面</a>
                            @endif
                        
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="fs-5 logout">ログアウト</button>
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>
    </header>

    @yield('content')

    <script src="{{ mix('js/app.js') }}" defer></script>
    <footer>
        <p class="footer-copyright">&copy; {{ date('Y') }} Surfing Information. All Rights Reserved.</p>
    </footer>
</body>
</html>
