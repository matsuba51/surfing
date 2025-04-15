@extends($layout)

@section('content')
    <div class="container mt-3">
        <h1>コメント編集</h1>

        <form action="{{ route('reviews.update', $review->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">タイトル</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $review->title) }}" required autocomplete="off">
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">コメント内容</label>
                <textarea name="content" id="content" class="form-control mb-1" rows="4" required autocomplete="off">{{ old('content', $review->content) }}</textarea>

                @if (!$errors->has('content'))
                    <small class="form-text bg-white p-1 rounded attention">
                        ＊10文字以上で入力してください。
                    </small>
                @endif

                @if ($errors->has('content'))
                    <div class="alert alert-danger py-1 mt-2">
                        @foreach ($errors->get('content') as $error)
                            <p class="m-0">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="mb-3">
                <label for="rating" class="form-label">評価（1〜5）</label>
                <select name="rating" id="rating" class="form-select" required autocomplete="off">
                    <option value="1" {{ $review->rating == 1 ? 'selected' : '' }}>★☆☆☆☆</option>
                    <option value="2" {{ $review->rating == 2 ? 'selected' : '' }}>★★☆☆☆</option>
                    <option value="3" {{ $review->rating == 3 ? 'selected' : '' }}>★★★☆☆</option>
                    <option value="4" {{ $review->rating == 4 ? 'selected' : '' }}>★★★★☆</option>
                    <option value="5" {{ $review->rating == 5 ? 'selected' : '' }}>★★★★★</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary mb-5">更新</button>
        </form>

        <div class="back-button">
            @if ($review->surf_spot_id)
                <a href="{{ route('surfspots.show', $review->surf_spot_id) }}" class="btn btn-secondary">サーフスポット詳細に戻る</a>
            @elseif ($review->shop_id)
                <a href="{{ route('shops.show', $review->shop_id) }}" class="btn btn-secondary">サーフショップ詳細に戻る</a>
            @else
                <a href="{{ route('reviews.index') }}" class="btn btn-secondary">レビュー一覧に戻る</a>
            @endif
        </div>
    </div>
@endsection
