<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<header class="border-bottom border-1 border-secondary">
    <nav class="navbar navbar-light bg-light">
        <h1>マイプレイリスト</h1>
            <p class="navbar-text mt-3">
                {{ Auth::user() -> name }} さん ログイン中
            </p>
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <form action="index" method="get">
                    <button class="btn btn-primary mr-3" type="submit">ホーム</button>
                </form>
            </li>
            <li class="nav-item">
                <form action="everyone_playlist" method="get">
                    <button class="btn btn-primary mr-3" type="submit">みんなのプレイリスト</button>
                </form>
            </li>
            <li class="nav-item">
                <form action="add_region" method="get">
                    <button class="btn btn-primary mr-3" type="submit">登録地追加</button>
                </form>
            </li>
            <li class="nav-item">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button class="btn btn-danger" type="submit">ログアウト</button>
                </form>
            </li>
        </ul>
    </nav>
</header>
<table border='1'>
    <tr>
        <th>プレイリスト名</th>
        <th>詳細</th>
    </tr>

    @foreach ($playlists as $playlist)
        <tr>
            <td>{{$playlist->list_name}}</td>
            <td><a href="/my_playlist">詳細</a></td>
        </tr>
    @endforeach
</table>
