@extends($layout)

@section('content')
    <div class="container my-5">
        <h1 class="text-center mb-4">サーフショップ追加</h1>

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
            <div class="card-body">
                <form action="{{ route('admin.shops.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">名前</label>
                        <input type="text" name="name" class="form-control" required  autocomplete="name">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">場所</label>
                        <input type="text" name="address" class="form-control" required autocomplete="street-address">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">電話番号</label>
                        <input type="text" name="phone" class="form-control" autocomplete="tel">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">メールアドレス</label>
                        <input type="email" name="email" class="form-control" autocomplete="email">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">説明</label>
                        <textarea name="description" class="form-control" required autocomplete="off"></textarea>
                    </div>

                    <div class="d-flex justify-content-evenly my-3 my-md-0">
                        <button type="submit" class="btn btn-success">追加</button>
                        <a href="{{ route('admin.shops.index') }}" class="btn btn-secondary mx-2">ショップ一覧へ戻る</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
