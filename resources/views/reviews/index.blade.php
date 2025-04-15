@extends($layout)

@section('content')
    <div class="container">
        <h1 class="mb-4">レビュー一覧</h1>

        <h3 class="mb-3">サーフスポットのレビュー</h3>
        @if ($surfspotReviews->isEmpty())
            <p>まだサーフスポットのレビューがありません。</p>
        @else
            @foreach ($surfspotReviews as $review)
                <div class="card mb-3">
                    <div class="card-body">
                        <h4 class="card-title">{{ $review->title }}</h4>
                        <p class="card-text">{{ $review->content }}</p>
                        <p class="card-text">評価: {{ $review->rating }} / 5</p>
                        <p class="card-text">スポット: <a href="{{ route('surfspots.show', $review->surf_spot_id) }}">{{ $review->surfSpot->name }}</a></p>
                    </div>
                </div>
            @endforeach
            {{ $surfspotReviews->links() }}
        @endif

        <h3 class="mb-3">ショップのレビュー</h3>
        @if ($shopReviews->isEmpty())
            <p>まだショップのレビューがありません。</p>
        @else
            @foreach ($shopReviews as $review)
                <div class="card mb-3">
                    <div class="card-body">
                        <h4 class="card-title">{{ $review->title }}</h4>
                        <p class="card-text">{{ $review->content }}</p>
                        <p class="card-text">評価: {{ $review->rating }} / 5</p>
                        <p class="card-text">ショップ: <a href="{{ route('shops.show', $review->shop_id) }}">{{ $review->shop->name }}</a></p>
                    </div>
                </div>
            @endforeach
            {{ $shopReviews->links() }}
        @endif
    </div>
@endsection
