@extends($layout)

@section('content')
    <div class="container my-5">
        <h1 class="text-center mb-4">サーフショップ詳細</h1>

        <div class="card mb-md-5">
            <div class="card-body">
                <dl>
                    <dt><strong>ID:</strong></dt>
                    <dd>{{ $shop->id }}</dd>
                    
                    <dt><strong>画像:</strong></dt>
                    <dd>
                        @if ($shop->image)
                            <p class="mb-1">{{ $shop->image }}</p>
                            <img src="{{ asset('images/' . $shop->image) }}" alt="{{ $shop->name }}" class="img-fluid" style="height: auto;">
                        @else
                            <p>画像なし</p>
                        @endif
                    </dd>

                    <dt><strong>名前:</strong></dt>
                    <dd>{{ $shop->name }}</dd>
                    
                    <dt><strong>場所:</strong></dt>
                    <dd>{{ $shop->address }}</dd>
                    
                    <dt><strong>説明:</strong></dt>
                    <dd>{{ $shop->description }}</dd>
                    
                    <dt><strong>電話番号:</strong></dt>
                    <dd>{{ $shop->phone }}</dd>
                    
                    <dt><strong>メールアドレス:</strong></dt>
                    <dd>{{ $shop->email }}</dd>
                    
                    <dt><strong>作成日:</strong></dt>
                    <dd>{{ $shop->created_at->format('Y-m-d H:i') }}</dd>
                    
                    <dt><strong>更新日:</strong></dt>
                    <dd>{{ $shop->updated_at->format('Y-m-d H:i') }}</dd>
                </dl>
                
                <div class="d-flex justify-content-evenly my-3">
                    <a href="{{ route('admin.shops.edit', $shop->id) }}" class="btn btn-warning">編集</a>
                    <form action="{{ route('admin.shops.destroy', $shop) }}" method="POST" onsubmit="return confirm('本当に削除しますか？')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger mx-2">削除</button>
                    </form>
                    <a href="{{ route('admin.shops.index') }}" class="btn btn-primary">一覧に戻る</a>
                </div>
            </div>
        </div>
    </div>
@endsection
