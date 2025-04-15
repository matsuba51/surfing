@extends($layout)

@section('content')
    <div class="container mt-3">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif 

        <h1 class="mb-4 text-center"> ユーザー一覧</h1>

        <div class="table-responsive">
            <table class="table table-striped text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>名前</th>
                        <th>メールアドレス</th>
                        <th>登録日</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format('Y-m-d') }}</td>
                            <td class="d-flex justify-content-center align-items-center">
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning btn-sm me-2">編集</a>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('本当に削除しますか？')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">削除</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex flex-column align-items-center">
            <div class="mb-3">
                <p class="mb-0">現在のページ: {{ $users->currentPage() }} / {{ $users->lastPage() }}</p>
            </div>
            <div>
                <ul class="pagination justify-content-center">
                    @php
                        $start = max(1, $users->currentPage() - 1);
                        $end = min($users->lastPage(), $users->currentPage() + 1);
                    @endphp

                    @if ($start > 1)
                        <li class="page-item">
                            <a class="page-link" href="{{ $users->url(1) }}">1</a>
                        </li>
                        @if ($start > 2)
                            <li class="page-item disabled"><span class="page-link">...</span></li>
                        @endif
                    @endif

                    @for ($page = $start; $page <= $end; $page++)
                        <li class="page-item {{ $page == $users->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $users->url($page) }}">{{ $page }}</a>
                        </li>
                    @endfor

                    @if ($end < $users->lastPage())
                        @if ($end < $users->lastPage() - 1)
                            <li class="page-item disabled"><span class="page-link">...</span></li>
                        @endif
                        <li class="page-item">
                            <a class="page-link" href="{{ $users->url($users->lastPage()) }}">{{ $users->lastPage() }}</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-2 mb-4">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary backーbutton back">ダッシュボードへ戻る</a>
        </div>
    </div>
@endsection
