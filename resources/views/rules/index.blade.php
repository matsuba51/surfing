@extends($layout)

@section('content')
    <div class="container mt-3 rules-main">
        <h1 class="mb-4 rules-h1">サーフィンのルール</h1>
        <p class="lead">サーフィンを楽しむために知っておくべき基本的なルールをご紹介します。</p>

        <div class="card mb-3 rules-contents">
            <div class="card-body">
                <h2 class="card-title">1. 他のサーファーに配慮する</h2>
                <p class="card-text">サーフスポットでは他のサーファーと順番を守って、みんなが楽しめるようにしましょう。</p>
            </div>
        </div>

        <div class="card mb-3 rules-contents">
            <div class="card-body">
                <h2 class="card-title">2. 波に乗ったらすぐに戻る</h2>
                <p class="card-text">波に乗った後は速やかに戻り、他のサーファーに道を譲りましょう。</p>
            </div>
        </div>

        <div class="card mb-3 rules-content">
            <div class="card-body">
                <h2 class="card-title">3. 安全第一</h2>
                <p class="card-text">常に自分の安全を最優先に考え、危険な状況を避けましょう。</p>
            </div>
        </div>

        <div class="d-flex justify-content-between back-button mt-4">
            <a href="{{ route('home') }}" class="btn btn-secondary">← 戻る</a>
            <button onclick="window.scrollTo({ top: 0, behavior: 'smooth' });" class="btn btn-secondary top-button" >↑ トップに戻る</button>
        </div>
    </div>
@endsection
