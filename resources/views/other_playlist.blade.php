<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <title>{{$playlist->user->name}}さんのプレイリスト</title>
</head>
<body>
    <h1>{{$playlist->user->name}}さんのプレイリスト</h1>
    <header class="border-bottom border-1 border-secondary">
        <nav class="navbar navbar-light bg-light">
            <h1>{{$playlist->user->name}}さんのプレイリスト</h1>
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

    <form action="" method="GET">
        <label>
            <input type="text" name="keyword3" placeholder="検索">
        </label>
        <input type="submit" value="検索">
    </form>

    <table border='1'>
        <tr>
            <th>ジャケット写真</th>
            <th>曲名</th>
            <th>アーティスト名</th>
            <th>プレリストに追加</th>
            <th>詳細情報</th>

        </tr>
        @foreach ($tracks as $track)
        <tr>
            <td><img src="{{$track->album->images[0]->url}}" width=80></td>
            <td>{{$track->name}}</td>
            <td>{{$track->artists[0]->name}}</td>
            <form action="add_myplaylist" method="get" enctype="multipart/form-data">
                <td><button type="submit" name="add_mylist" value='{{$track->id}}'>リストへ追加</button></td>
            </form>
            <form action="information" method="get" enctype="multipart/form-data">
                <td><button type="submit" name="information" value='{{$track->id}}'>詳細情報</button></td>
            </form>
        </tr>
        @csrf
        @endforeach
    </table>


    <form action="{{route('logout')}}" method="post">
        <button type="submit">ログアウト</button>
        @csrf
    </form>

</body>
</html>

