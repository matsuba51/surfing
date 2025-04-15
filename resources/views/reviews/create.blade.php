@extends($layout)

@section('content')
    <div class="container">
        <h2>レビューを投稿する</h2>

        <form action="{{ route('reviews.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">タイトル</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required autocomplete="off">
                <small class="form-text text-muted">タイトルは最大255文字です。</small>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">レビュー内容</label>
                <textarea name="content" id="content" class="form-control" rows="4" required>{{ old('content') }}</textarea autocomplete="off">
                <small class="form-text text-muted">レビュー内容を記入してください。</small>
            </div>

            <div class="mb-3">
                <label for="rating" class="form-label">評価（1〜5）</label>
                <select name="rating" id="rating" class="form-select" required autocomplete="off">
                    <option value="1" {{ old('rating') == 1 ? 'selected' : '' }}>1 - ★☆☆☆☆</option>
                    <option value="2" {{ old('rating') == 2 ? 'selected' : '' }}>2 - ★★☆☆☆</option>
                    <option value="3" {{ old('rating') == 3 ? 'selected' : '' }}>3 - ★★★☆☆</option>
                    <option value="4" {{ old('rating') == 4 ? 'selected' : '' }}>4 - ★★★★☆</option>
                    <option value="5" {{ old('rating') == 5 ? 'selected' : '' }}>5 - ★★★★★</option>
                </select>
                <small class="form-text text-muted">評価を選択してください。</small>
            </div>

            <button type="submit" class="btn btn-primary">投稿</button>
        </form>
    </div>
@endsection
