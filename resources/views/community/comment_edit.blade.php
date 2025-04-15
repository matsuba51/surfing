@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>コメント編集</h1>
        <form method="POST" action="{{ route('comments.update', [$post->id, $comment->id]) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="body">コメント内容</label>
                <textarea name="body" id="body" class="form-control" rows="4" required autocomplete="off">{{ old('body', $comment->body) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary mt-3">更新</button>
        </form>
    </div>
@endsection
