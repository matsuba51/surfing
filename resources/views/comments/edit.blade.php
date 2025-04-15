@extends($layout)

@section('content')
    <div class="container">
        <h1 class="mt-3">コメント編集</h1>
        <form method="POST" action="{{ route('comments.update', [$post->id, $comment->id]) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="content">コメント内容</label>
                <textarea name="content" id="content" class="form-control" rows="4" required autocomplete="off">{{ old('content', $comment->content) }}</textarea>
            </div>

            <div class="my-5">
              <button type="submit" class="btn btn-primary me-2">更新</button>
              <a href="{{ route('community.index') }}" class="btn btn-secondary">戻る</a>
            </div>
        </form>
    </div>
@endsection
