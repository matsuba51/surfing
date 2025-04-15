<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
    <div class="container">
    
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ asset('images/rogo.png') }}" alt="ロゴ" class="logo-img">
        </a>

        <!-- ハンバーガーメニュー（モバイル用） -->
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- ナビゲーションメニュー -->
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">メニュー</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body d-flex flex-column align-items-center">

                @guest
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg w-100 py-3 my-2">新規登録</a>
                    <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg w-100 py-3 my-2">ログイン</a>
                @endguest

                <div class="mt-4 w-100">
                    <a class="btn btn-light btn-lg w-100 py-3 my-2" href="{{ route('surfspots.index') }}">🏄‍♂️ サーフスポット</a>
                    <a class="btn btn-light btn-lg w-100 py-3 my-2" href="{{ route('surfshops.index') }}">🏪 サーフショップ</a>
                    <a class="btn btn-light btn-lg w-100 py-3 my-2" href="{{ route('rules.index') }}">📜 サーフィンのルール</a>
                    <a class="btn btn-light btn-lg w-100 py-3 my-2" href="{{ route('events.index') }}">🎉 イベント情報</a>
                    <a class="btn btn-light btn-lg w-100 py-3 my-2" href="{{ route('community.index') }}">🤝 交流会</a>
                </div>

                <!--  ログイン後のメニュー（プロフィール＆ログアウト)  -->
                @auth
                    <hr class="w-100 my-4">

                    <!--  管理者メニュー  -->
                    @if (Auth::user()->isAdmin())
                        <a class="btn btn-warning btn-lg w-100 py-3 my-2" href="{{ route('admin.dashboard') }}">⚙️ 管理画面</a>
                    @endif

                    <div class="w-100">
                        <a class="btn btn-secondary btn-lg w-100 py-3 my-2" href="{{ route('profile.edit') }}">👤 プロフィール</a>
                        <form method="POST" action="{{ route('logout') }}" class="w-100">
                            @csrf
                            <button class="btn btn-danger btn-lg w-100 py-3 my-2" type="submit">🚪 ログアウト</button>
                        </form>
                    </div>
                @endauth

            </div>
        </div>
    </div>
</nav>
