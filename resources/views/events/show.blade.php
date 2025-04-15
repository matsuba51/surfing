@extends($layout)

@section('content')
    <div class="container mt-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="card-title text-center mb-4">{{ $event->title }}</h1>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>日付:</strong> {{ $event->date }}</p>
                        <p><strong>場所:</strong> {{ $event->location }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>詳細:</strong></p>
                        <p class="text-muted">{{ $event->description }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ route('events.index') }}" class="btn btn-outline-primary">← イベント一覧に戻る</a>
        </div>
    </div>
@endsection