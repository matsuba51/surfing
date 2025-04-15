@extends($layout)

@section('content')
    <div class="container mt-3">
        <h1>投稿を編集</h1>

        <form action="{{ route('community.update', $post->id) }}" method="POST" class="mb-3">
            @csrf
            @method('PUT')
            
            <input type="text" name="title" class="form-control" value="{{ old('title', $post->title) }}" required autocomplete="off">
            <textarea name="content" rows="4" class="form-control mt-2" required  autocomplete="off">{{ old('content', $post->content) }}</textarea>

            <div class="my-5">
                <button type="submit" class="btn btn-success me-3">更新</button>
                <a href="{{ route('community.index') }}" class="btn btn-secondary">戻る</a>
            </div>
        </form>
    </div>   
@endsection
