@extends($layout)

@section('content')
    <div class="container mt-3">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        <h1 class="mb-4">レビュー詳細</h1>
        
        <div class="card mb-5">
            <div class="card-body">
                <h5 class="card-title">{{ $review->title }}</h5>
                <p><strong>内容:</strong> {{ $review->content }}</p>
                <p><strong>評価:</strong> {{ $review->rating }}</p>
                <p><strong>ユーザーID:</strong> {{ $review->user_id }}</p>
                <p><strong>作成日時:</strong> {{ $review->created_at->format('Y-m-d H:i') }}</p>
            </div>
        </div>

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
