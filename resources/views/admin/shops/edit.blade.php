@extends($layout)

@section('content')
    <div class="container my-5">
        <h1 class="text-center mb-4">サーフショップ編集</h1>

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
                <h5 class="text-center mb-0">{{ $shop->name }} の情報</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.shops.update', $shop) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label">ID</label>
                        <input type="text" class="form-control" value="{{ $shop->id }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">名前</label>
                        <input type="text" name="name" class="form-control" value="{{ $shop->name }}" required autocomplete="name">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">場所</label>
                        <input type="text" name="address" class="form-control" value="{{ $shop->address }}" required autocomplete="street-address">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">電話番号</label>
                        <input type="text" name="phone" class="form-control" value="{{ $shop->phone }}" autocomplete="tel">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">メールアドレス</label>
                        <input type="email" name="email" class="form-control" value="{{ $shop->email }}" autocomplete="email">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">説明</label>
                        <textarea name="description" class="form-control" autocomplete="off">{{ $shop->description }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">作成日</label>
                        <input type="text" class="form-control" value="{{ $shop->created_at->format('Y-m-d H:i') }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">更新日</label>
                        <input type="text" class="form-control" value="{{ $shop->updated_at->format('Y-m-d H:i') }}" disabled>
                    </div>
                    
                    <div class="d-flex justify-content-evenly mt-4">
                        <button type="submit" class="btn btn-success me-md-4">更新</button>
                        <a href="{{ route('admin.shops.index') }}" class="btn btn-secondary">一覧へ戻る</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
