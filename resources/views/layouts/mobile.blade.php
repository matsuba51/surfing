<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>サーフィン情報サイト</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;600&display=swap" rel="stylesheet">
    <!-- 以下、Bootstrap 5 関連 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css'])
</head>

<body class="font-sans antialiased">
    <div class="d-flex flex-column min-vh-100">
        @include('layouts.navigation')

        @isset($header)
            <header class="container text-center py-3">
                <h1>{{ config('app.name', 'Surfing App') }}</h1>
                @if(Auth::check())
                    <p class="greeting-message">こんにちは、{{ Auth::user()->name }}さん！</p>
                @else
                    <p class="greeting-message">ログインしてください。</p>
                @endif
            </header>
        @endisset

        <main class="flex-grow-1 d-flex justify-content-center">
            <div class="outer-container w-100">
                <div class="container-inner">
                    @yield('content')
                </div>
            </div>
        </main>

       
        <footer>
            <p class="footer-copyright">&copy; {{ date('Y') }} Surfing Information. All Rights Reserved.</p>
        </footer>
    </div> 

    @vite(['resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
