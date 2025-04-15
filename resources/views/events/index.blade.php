@extends($layout)

@section('content')
    <div class="container mt-3">
        <h1 class="text-center mb-3 event-h1">サーフィンイベント</h1>

        <div class="spot-grid details-color event-content">
            @foreach ($events as $event)
                <div class="spot-grid mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h3 class="card-title">{{ $event->title }}</h3>
                            <p class="card-text">{{ $event->description }}</p>
                            <p class="text-muted"><strong>開催日:</strong> {{ $event->date }}</p>
                            <p class="text-muted"><strong>開催場所:</strong> {{ $event->location }}</p>
                            <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary w-100">詳細を見る</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-between back-button mt-4">
            <a href="{{ route('home') }}" class="btn btn-secondary">← 戻る</a>
            <button onclick="window.scrollTo({ top: 0, behavior: 'smooth' });" class="btn btn-secondary top-button">↑ トップに戻る</button>
        </div>
    </div>
@endsection
