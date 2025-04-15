@extends($layout)

@section('content')
    <div class="container mt-3">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <h1 class="mb-4 text-center">ユーザー編集</h1>

        <div class="card mb-md-5">
            <div class="card-body">
                <form action="{{ route('admin.users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">名前</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required autocomplete="name">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">メールアドレス</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required autocomplete="email">
                    </div>

                    <div class="d-flex justify-content-evenly my-4">
                        <button type="submit" class="btn btn-primary">更新</button>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">戻る</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
