<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <title>プレイリストへ追加</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-light bg-light">
            <h1>プレイリストに追加</h1>
                <p class="navbar-text mt-3">
                    {{ Auth::user() -> name }} さん ログイン中
                </p>
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <form action="index" method="get">
                        <button class="btn btn-primary" type="submit">ホーム</button>
                    </form>
                </li>
                <li class="nav-item">
                    <form action="everyone_playlist" method="get">
                        <button class="btn btn-primary" type="submit">みんなのプレイリスト</button>
                    </form>
                </li>
                <li class="nav-item">
                    <form action="add_region" method="get">
                        <button class="btn btn-primary" type="submit">登録地追加</button>
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
    <form action="" method="POST">
        プレイリスト名
        <input type="text" name="playlist_name" placeholder="新規プレイリスト">

        <select name="list_id">
            <option hidden>プレイリスト選択</option>
            @foreach ($playlists as $playlist)
                <option value="{{$playlist->id}}">{{$playlist->list_name}}</option>
            @endforeach
        </select>
        <br>

        曲名
        <input type="text" name="title" value="{{$track->name}}" readonly><br>
        アーティスト
        <input type="text" name="artist" value="{{$track->artists[0]->name}}" readonly><br>

        {{-- trackIdの流用 --}}
        <input type="hidden" name="trackId" value="{{$trackId}}">
        <input type="submit" value="追加">
        @csrf
    </form>

    <form action="{{route('logout')}}" method="post">
        <button type="submit">ログアウト</button>
        @csrf
    </form>
</body>
</html>
