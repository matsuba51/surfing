@extends($layout)

@section('content')
    <div class="container mt-3">
        <div class="d-flex align-items-center justify-content-between mb-4 title-back">
            <h1 class="mb-0">ダッシュボード</h1>
            <a href="{{ '/' }}" class="btn btn-secondary">戻る</a>
        </div>

        <p class="description">管理者用ダッシュボードのコンテンツです。</p>

        <div class="row mt-4">
            <div class="col-md-6 mb-2">
                <a href="{{ route('admin.spots.index') }}" class="card text-dark text-decoration-none">
                    <div class="card-body">
                        <h5 class="card-title">サーフスポット一覧</h5>
                        <p class="card-text">登録されているサーフスポットの管理ができます。</p>
                    </div>
                </a>
            </div>
            <div class="col-md-6 mb-2">
                <a href="{{ route('admin.shops.index') }}" class="card text-dark text-decoration-none">
                    <div class="card-body">
                        <h5 class="card-title">サーフショップ一覧</h5>
                        <p class="card-text">登録されているサーフショップの管理ができます。</p>
                    </div>
                </a>
            </div>
            <div class="col-md-6 mb-5">
                <a href="{{ route('admin.users.index') }}" class="card text-dark text-decoration-none">
                    <div class="card-body">
                        <h5 class="card-title">ユーザー一覧</h5>
                        <p class="card-text">登録ユーザーの管理を行えます。</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- グラフ表示エリア -->
        <h2 class="text-center mt-2">訪問者数の推移</h2>
        <canvas id="visitChart" class="mb-5" style="height: 400px; background-color: aliceblue;"></canvas>
    </div>

    <!-- Chart.js の読み込み -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            fetch("{{ route('admin.dashboard.stats') }}")
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTPエラー! ステータス: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log("取得したデータ:", data);

                    if (Array.isArray(data)) {
                        const visitLabels = data.map(item => item.date);  // 訪問日
                        const visitCounts = data.map(item => item.count);  // 訪問者数

                        const ctx = document.getElementById('visitChart').getContext('2d');
                        new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: visitLabels,  // 訪問日付
                                datasets: [
                                    {
                                        label: '訪問者数',
                                        data: visitCounts,
                                        borderColor: 'rgba(75, 192, 192, 1)',
                                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                        borderWidth: 2
                                    }
                                ]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        suggestedMin: 1
                                    }
                                }
                            }
                        });

                    } else {
                        console.error("データ形式が不正です", data);
                    }
                })
                .catch(error => {
                    console.error("データ取得エラー:", error);
                });
        });
    </script>
@endsection
