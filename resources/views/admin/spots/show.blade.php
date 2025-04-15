@extends($layout)

@section('content')
    <div class="container my-5">
        <h1 class="text-center mb-4">サーフスポット詳細</h1>

        <div class="card mb-md-5">
            <div class="card-body">
                
                <dl>
                    <dt><strong>ID:</strong></dt>
                    <dd>{{ $spot->id }}</dd>

                    <dt><strong>画像:</strong></dt>
                    <dd>
                        @if ($spot->image)
                            <p class="mb-1">{{ $spot->image }}</p>
                            <img src="{{ asset('images/' . $spot->image) }}" alt="{{ $spot->name }}" class="img-fluid" style="height: auto;">
                        @else
                            <p>画像なし</p>
                        @endif
                    </dd>

                    <dt><strong>名前:</strong></dt>
                    <dd>{{ $spot->name }}</dd>

                    <dt><strong>場所:</strong></dt>
                    <dd>{{ $spot->address }}</dd>

                    <dt><strong>説明:</strong></dt>
                    <dd>{{ $spot->description }}</dd>
                </dl>

                <div class="d-flex justify-content-evenly my-3">
                    <a href="{{ route('admin.spots.edit', $spot) }}" class="btn btn-warning">編集</a>
                    <form action="{{ route('admin.spots.destroy', $spot) }}" method="POST" onsubmit="return confirm('本当に削除しますか？')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger mx-2">削除</button>
                    </form>
                    <a href="{{ route('admin.spots.index') }}" class="btn btn-secondary">一覧へ戻る</a>
                </div>
            </div>
        </div>
    </div>
@endsection
