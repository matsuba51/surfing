@extends($layout)

@section('content')
    <div class="container mt-3 main">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger p-2">
                <ul class="m-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card spots-details">
            <div class="card-body">
                <h1 class="text-center mb-4">{{ $shop->name }}の詳細</h1>
                <p class="lead">{{ $shop->description }}</p>
                <div class="card-body">
                    <dl>            
                        <dt>画像：</dt>
                        <dd class="show-dd"><img src="{{ asset('images/' . $shop->image) }}" alt="ショップ画像" class="img-fluid"></dd>

                        <dt><strong>場所:</strong></dt>
                        <dd>{{ $shop->address }}</dd>
                        
                        <dt><strong>説明:</strong></dt>
                        <dd>{{ $shop->description }}</dd>
                        
                        <dt><strong>電話番号:</strong></dt>
                        <dd>{{ $shop->phone }}</dd>
                        
                        <dt><strong>メールアドレス:</strong></dt>
                        <dd>{{ $shop->email }}</dd>
                    </dl>
                </div>
            </div>
        </div>

        <h2 class="mt-5">レビュー一覧</h2>
        @if ($shopReviews->isEmpty())
            <p>まだレビューはありません。</p>
        @else
            @foreach ($shopReviews as $review)
                <div class="card mb-3">
                    <div class="card-body">
                        <h4 class="card-title">{{ $review->title }}</h4>
                        <p class="card-text">{{ $review->content }}</p>
                        <p class="text-muted">評価: {{ $review->rating }} / 5</p>
                        <small class="text-muted">投稿者: {{ $review->user->name }} | 投稿日: {{ $review->created_at->format('Y-m-d') }}</small>

                        @auth
                            @if ($review->user_id == Auth::id())
                                <div class="mt-2">
                                    <a href="{{ route('reviews.edit', $review->id) }}" class="btn btn-warning btn-sm">編集</a>
                                    <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('本当に削除しますか？')">削除</button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
            @endforeach
        @endif

        <h2 class="mt-5">レビューを書く</h2>
        @auth
            <form action="{{ route('reviews.store') }}" method="POST" class="mt-3 mb-5">
                @csrf
                <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                
                <div class="mb-3">
                    <label for="title" class="form-label">タイトル</label>
                    <input type="text" id="title" name="title" class="form-control" required>
                </div>

                <div class="mb-2">
                    <label for="content" class="form-label">レビュー内容</label>
                    <textarea name="content" id="content" class="form-control" rows="4" required></textarea>
                </div>

                <!-- 注意事項 -->
                @if (!$errors->has('content'))
                    <div class="form-text bg-white p-1 rounded attention mb-3">
                        ＊10文字以上で入力してください。
                    </div>
                @endif

                <div class="mb-3">
                    <label for="rating" class="form-label">評価（1〜5）</label>
                    <select name="rating" id="rating" class="form-select" required>
                        <option value="1">★☆☆☆☆</option>
                        <option value="2">★★☆☆☆</option>
                        <option value="3">★★★☆☆</option>
                        <option value="4">★★★★☆</option>
                        <option value="5">★★★★★</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary w-100">投稿</button>
            </form>
        @else
            <div class="card mt-3 mb-5 review bg-warning-subtle">
                <p class="card-body m-0">
                    <a href="{{ route('login') }}">ログインすると、レビューを投稿できます。</a>
                </p>
            </div>
        @endauth

        <div class="d-flex justify-content-between spot-button back-button">
            <a href="{{ route('surfshops.index') }}" class="btn btn-secondary">← 戻る</a>
            <button onclick="window.scrollTo({ top: 0, behavior: 'smooth' });" class="btn btn-secondary">↑ トップに戻る</button>
        </div>
    </div>
@endsection