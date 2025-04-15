@extends($layout)

@section('content')
    <div class="container my-5">
        <h1 class="text-center mb-4">サーフスポットの編集</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card mb-md-5">
            <div class="card-header bg-primary text-white">
                <h5 class="text-center mb-0">{{ $spot->name }} の情報</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.spots.update', $spot) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">名前</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $spot->name) }}" required autocomplete="name">
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">場所</label>
                        <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $spot->address) }}" required autocomplete="address">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">説明</label>
                        <textarea name="description" id="description" class="form-control" autocomplete="off">{{ old('description', $spot->description) }}</textarea>
                    </div>

                    <div class="d-flex justify-content-evenly mt-4">
                        <button type="submit" class="btn btn-warning">更新</button>
                        <a href="{{ route('admin.spots.index') }}" class="btn btn-secondary mx-2">一覧へ戻る</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
