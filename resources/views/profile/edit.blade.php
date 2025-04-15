@extends($layout)

@section('content')
    <div class="container my-5">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <h1>プロフィール編集</h1>

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="name">名前</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ Auth::user()->name }}" required autocomplete="name">
            </div>
            <div class="form-group mt-3">
                <label for="email">メールアドレス</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ Auth::user()->email }}" required autocomplete="email">
            </div>
            <button type="submit" class="btn btn-primary mt-3">更新</button>
        </form>

        <hr>

        <div class="mt-4">
            <h2>アカウント削除</h2>

            <form action="{{ route('profile.destroy') }}" method="POST" onsubmit="return confirm('本当にアカウントを削除しますか？');">
                @csrf
                @method('DELETE')
                <div class="form-group">
                    <label for="password">パスワード確認</label>
                    <input type="password" id="password" name="password" class="form-control" required autocomplete="current-password">
                </div>

                <div class="my-4">
                    <p class="text-danger p-2 bg-danger text-white rounded">アカウントを削除すると、復元できません。本当に削除しますか？</p>
                </div>
                
                <div class="my-5">
                    <button type="submit" class="btn btn-danger me-5">アカウント削除</button>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">戻る</a>
                </div>
            </form>
        </div>
    </div>
@endsection
