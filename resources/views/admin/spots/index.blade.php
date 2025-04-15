@extends($layout)

@section('content')
    <div class="container mt-3">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <h1 class="mb-4 text-center">サーフスポット一覧</h1>
        
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('admin.spots.create') }}" class="btn btn-primary">新規追加</a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th class="col-1">ID</th>
                        <th class="col-4">名前</th>
                        <th class="col-4">場所</th>
                        <th class="col-2">操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($spots as $spot)
                        <tr>
                            <td>{{ $spot->id }}</td>
                            <td>{{ $spot->name }}</td>
                            <td>{{ $spot->address }}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('admin.spots.show', $spot) }}" class="btn btn-info btn-sm me-2">詳細</a>
                                    <a href="{{ route('admin.spots.edit', $spot) }}" class="btn btn-warning btn-sm me-2">編集</a>
                                    <form action="{{ route('admin.spots.destroy', $spot) }}" method="POST" onsubmit="return confirm('本当に削除しますか？')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">削除</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center flex-column align-items-center">
            
            <p>現在、ページ {{ $spots->currentPage() }} / {{ $spots->lastPage() }} ページ目</p>
        
            <nav>
                <ul class="pagination">
                    @if ($spots->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link">前へ</span>
                        </li>
                    @else
                        <li class="page-item d-none d-sm-block">
                            <a class="page-link" href="{{ $spots->previousPageUrl() }}">前へ</a>
                        </li>
                    @endif

                    @if ($spots->currentPage() > 2)
                        <li class="page-item">
                            <a class="page-link" href="{{ $spots->url(1) }}">1</a>
                        </li>
                        <li class="page-item disabled">
                            <span class="page-link">...</span>
                        </li>
                    @endif

                    @for ($i = max(1, $spots->currentPage() - 1); $i <= min($spots->lastPage(), $spots->currentPage() + 1); $i++)
                        <li class="page-item {{ $spots->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $spots->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    @if ($spots->currentPage() < $spots->lastPage() - 1)
                        <li class="page-item disabled">
                            <span class="page-link">...</span>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="{{ $spots->url($spots->lastPage()) }}">{{ $spots->lastPage() }}</a>
                        </li>
                    @endif

                    @if ($spots->hasMorePages())
                        <li class="page-item d-none d-sm-block">
                            <a class="page-link" href="{{ $spots->nextPageUrl() }}">次へ</a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <span class="page-link">次へ</span>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>

        <div class="d-flex justify-content-center mt-3 mb-5">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary backーbutton back">ダッシュボードへ戻る</a>
        </div>
    </div>
@endsection
