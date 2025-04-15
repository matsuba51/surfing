@extends($layout)

@section('content')
    <div class="container mt-3">
        <h1 class="text-center mb-4 same-h1">サーフスポット一覧</h1>

        @if ($spots->isEmpty())
            <p class="text-center">サーフスポットは、まだ登録されていません。</p>
        @else
            <div class="spot-grid details-color">
                @foreach ($spots as $spot)
                    <div class="spot-grid mb-4">
                        <div class="card h-100 shadow-sm mb-4">
                            <img src="{{ asset('images/kanegahama.jpg') }}" class="card-img-top" alt="{{ $spot->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $spot->name }}</h5>
                                <p class="card-text">{{ $spot->description }}</p>
                                <p class="text-muted">{{ $spot->location }}</p>
                                <a href="{{ route('surfspots.show', $spot->id) }}" class="btn btn-primary w-100">詳細を見る</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="d-flex flex-column align-items-center mb-4">
            <p class="mb-2 page">
                {{ $spots->firstItem() }} - {{ $spots->lastItem() }} 件目を表示（全 {{ $spots->total() }} 件）
            </p>

            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">

                    @if ($spots->onFirstPage())
                        <li class="page-item disabled"><span class="page-link">前へ</span></li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $spots->previousPageUrl() }}" rel="prev">前へ</a>
                        </li>
                    @endif

                    @php
                        $current = $spots->currentPage();
                        $last = $spots->lastPage();
                        $start = max(1, $current - 1);
                        $end = min($last, $current + 1);
                    @endphp

                    @if ($start > 1)
                        <li class="page-item disabled"><span class="page-link">…</span></li>
                    @endif

                    @for ($i = $start; $i <= $end; $i++)
                        <li class="page-item {{ $current == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $spots->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    @if ($end < $last)
                        <li class="page-item disabled"><span class="page-link">…</span></li>
                    @endif

                    @if ($spots->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $spots->nextPageUrl() }}" rel="next">次へ</a>
                        </li>
                    @else
                        <li class="page-item disabled"><span class="page-link">次へ</span></li>
                    @endif

                </ul>
            </nav>
        </div>

        <div class="d-flex justify-content-between back-button">
            <a href="{{ route('home') }}" class="btn btn-secondary">← 戻る</a>
            <button onclick="window.scrollTo({ top: 0, behavior: 'smooth' });" class="btn btn-secondary">↑ トップに戻る</button>
        </div>
    </div>
@endsection
