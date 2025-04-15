@extends($layout)

@section('content')
    <div class="container my-5">
        <h1 class="text-center mb-4">サーフスポットの追加</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <div class="card mb-md-5">
            <div class="card-body">
                <form action="{{ route('admin.spots.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">名前</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required autocomplete="name">
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">場所</label>
                        <input type="text" name="address" id="address" class="form-control" value="{{ old('location') }}" required autocomplete="address">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">説明</label>
                        <textarea name="description" id="description" class="form-control" autocomplete="off">{{ old('description') }}</textarea>
                    </div>

                    <div class="d-flex justify-content-evenly mt-4">
                        <button type="submit" class="btn btn-primary mx-2">追加</button>
                        <a href="{{ route('admin.spots.index') }}" class="btn btn-secondary mx-2">一覧へ戻る</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
