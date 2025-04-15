@extends($layout)

@section('content')
    <div class="container mt-3">
        <h1 class="text-center mb-4 same-h1">サーフショップ一覧</h1>

        @if ($shops->isEmpty())
            <p class="text-center">サーフショップは、まだ登録されていません。</p>
        @else
            <div class="spot-grid details-color">
                @foreach ($shops as $shop)
                    <div class="spot-item mb-4">
                        <div class="card h-100 shadow-sm mb-4">
                            <img src="{{ asset('images/shop.jpg') }}" class="card-img-top" alt="{{ $shop->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $shop->name }}</h5>
                                <p class="card-text">{{ Str::limit($shop->description, 100) }}</p>
                                <a href="{{ route('shops.show', $shop->id) }}" class="btn btn-primary w-100">詳細を見る</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="d-flex flex-column align-items-center mb-4">
            <p class="mb-2 page">
                {{ $shops->firstItem() }} - {{ $shops->lastItem() }} 件目を表示（全 {{ $shops->total() }} 件）
            </p>

            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">

                    @if ($shops->onFirstPage())
                        <li class="page-item disabled"><span class="page-link">前へ</span></li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $shops->previousPageUrl() }}" rel="prev">前へ</a>
                        </li>
                    @endif

                    @php
                        $current = $shops->currentPage();
                        $last = $shops->lastPage();
                        $start = max(1, $current - 1);
                        $end = min($last, $current + 1);
                    @endphp

                    @if ($start > 1)
                        <li class="page-item disabled"><span class="page-link">…</span></li>
                    @endif

                    @for ($i = $start; $i <= $end; $i++)
                        <li class="page-item {{ $current == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $shops->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    @if ($end < $last)
                        <li class="page-item disabled"><span class="page-link">…</span></li>
                    @endif

                    @if ($shops->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $shops->nextPageUrl() }}" rel="next">次へ</a>
                        </li>
                    @else
                        <li class="page-item disabled"><span class="page-link">次へ</span></li>
                    @endif

                </ul>
            </nav>
        </div>

        <div class="d-flex justify-content-between back-button mt-4">
            <a href="{{ route('home') }}" class="btn btn-secondary">← 戻る</a>
            <button onclick="window.scrollTo({ top: 0, behavior: 'smooth' });" class="btn btn-secondary">↑ トップに戻る</button>
        </div>
    </div>
@endsection
