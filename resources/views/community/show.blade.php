@extends($layout)

@section('content')
    <div class="container mt-3">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <h1>投稿詳細</h1>

        <div class="post-detail form-control mb-4">
            <h3>{{ $post->title }}</h3>
            <p><strong>{{ $post->user->name }}</strong>（{{ $post->created_at->format('Y-m-d H:i') }}）</p>
            <p class="m-0">{{ $post->content }}</p>
        </div>

        <h3>コメントを追加</h3>
        @auth
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('comments.store', $post->id) }}" method="POST">
                @csrf
                <textarea name="content" rows="4" class="form-control mb-2" placeholder="コメントを入力してください" required>{{ old('content') }}</textarea>
                <button type="submit" class="btn btn-primary mb-4">コメント投稿</button>
            </form>
        @else
            <div class="card mt-3 mb-5 review bg-warning-subtle">
                <p class="card-body m-0">
                    <a href="{{ route('login') }}">ログインすると、レビューを投稿できます。</a>
                </p>
            </div>
        @endauth

        <h3>コメント一覧</h3>
        @forelse($post->comments as $comment)
            <div class="comment form-control mb-3">
                <p><strong>{{ $comment->user->name }}</strong>（{{ $comment->created_at->format('Y-m-d H:i') }}）</p>
                <p class="m-0">{{ $comment->content }}</p>

                @if (Auth::id() === $comment->user_id)
                <a href="{{ route('comments.edit', [$post->id, $comment->id]) }}" class="btn btn-sm btn-secondary">編集</a>
                    <form action="{{ route('comments.destroy', [$post->id, $comment->id]) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">削除</button>
                    </form>  
                @endif
            </div>
        @empty
            <p>まだコメントはありません。</p>
        @endforelse

        <div class="d-flex justify-content-between spot-button back-button">
            <a href="{{ route('community.index') }}" class="btn btn-secondary">← 戻る</a>
            <button onclick="window.scrollTo({ top: 0, behavior: 'smooth' });" class="btn btn-secondary">↑ トップに戻る</button>
        </div>
    </div>
@endsection
