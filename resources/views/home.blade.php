@extends($layout)

@section('content')
    <div class="container py-5 text-white content">
        <h1 class="text-center mb-4">サーフィン情報サイト</h1>

        <div class="row justify-content-center g-3">
            <div class="col-md-4 text-center">
                <a href="{{ route('surfspots.index') }}" class="btn btn-primary w-100 w-md-70 p-3">サーフスポット</a>
            </div>
            <div class="col-md-4 text-center">
                <a href="{{ route('surfshops.index') }}" class="btn btn-primary w-100 w-md-70 p-3">サーフショップ</a>
            </div>
            <div class="col-md-4 text-center">
                <a href="{{ route('rules.index') }}" class="btn btn-primary w-100 w-md-70 p-3">サーフィンのルール</a>
            </div>
            <div class="col-md-4 text-center">
                <a href="{{ route('events.index') }}" class="btn btn-primary w-100 w-md-70 p-3">イベント情報</a>
            </div>
            <div class="col-md-4 text-center">
                <a href="{{ route('community.index') }}" class="btn btn-primary w-100 w-md-70 p-3">ユーザー同士の交流</a>
            </div>
        </div>
    </div>
@endsection
