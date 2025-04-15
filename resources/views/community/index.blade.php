@extends($layout)

@section('content')
    <div class="container mt-3">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif  

        <h1>ユーザー同士の交流</h1>

        @auth
        <form action="{{ route('community.store') }}" method="POST">
            @csrf
            <input type="text" name="title" class="form-control" placeholder="タイトルを入力してください" required>
            <textarea name="content" rows="4" class="form-control mt-2" placeholder="投稿内容を入力してください" required></textarea>
            <button type="submit" class="btn btn-primary mt-2">投稿</button>
        </form>
        @endauth

        <hr>

        <h3>投稿一覧</h3>
        @foreach($posts as $post)
            <div class="post form-control mb-3">
                <p class="m-0">
                    <a href="{{ route('community.show', $post->id) }}"><strong>{{ $post->title }}</strong></a>
                    （{{ $post->created_at->format('Y-m-d H:i') }}）
                </p>

                @if(Auth::check() && Auth::id() === $post->user_id)
                    <div class="mt-2">
                        <a href="{{ route('community.edit', $post->id) }}" class="btn btn-warning btn-sm">編集</a>
                        <form action="{{ route('community.destroy', $post->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('本当に削除しますか？')">削除</button>
                        </form>
                    </div>
                @endif
            </div>
        @endforeach

        <div class="mt-4 d-flex flex-column align-items-center">
            <p class="mb-2 page">
                {{ $posts->firstItem() }} - {{ $posts->lastItem() }} 件目を表示（全 {{ $posts->total() }} 件）
            </p>

            <nav aria-label="Page navigation">
                <ul class="pagination">
                    @if ($posts->onFirstPage())
                        <li class="page-item disabled"><span class="page-link">前へ</span></li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $posts->previousPageUrl() }}" rel="prev">前へ</a>
                        </li>
                    @endif

                    @php
                        $current = $posts->currentPage();
                        $last = $posts->lastPage();
                        $start = max(1, $current - 1);
                        $end = min($last, $current + 1);
                    @endphp

                    @if ($start > 1)
                        <li class="page-item disabled"><span class="page-link">…</span></li>
                    @endif

                    @for ($i = $start; $i <= $end; $i++)
                        <li class="page-item {{ $current == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $posts->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    @if ($end < $last)
                        <li class="page-item disabled"><span class="page-link">…</span></li>
                    @endif

                    @if ($posts->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $posts->nextPageUrl() }}" rel="next">次へ</a>
                        </li>
                    @else
                        <li class="page-item disabled"><span class="page-link">次へ</span></li>
                    @endif
                </ul>
            </nav>
        </div>

        <div class="d-flex justify-content-between mb-5">
            <a href="{{ route('home') }}" class="btn btn-secondary">← 戻る</a>
            <button onclick="window.scrollTo({ top: 0, behavior: 'smooth' });" class="btn btn-secondary">↑ トップに戻る</button>
        </div>
    </div>
@endsection
