<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>プレイリストへ追加</title>
</head>

<body>
    <h1>プレイリストへ追加</h1>
    <form action="" method="POST">
        プレイリスト名
        <input type="text" name="playlist_name" placeholder="新規プレイリスト">

        プレイリスト選択▼
        {{-- <select>
            @foreach ($playlists as $playlist){
                <option>{{$playlist->list_name}}</option>
            }
            @endforeach
            --}}
        <br>

        曲名
        <input type="text" name="title" value="{{$title}}"><br>
        アーティスト
        <input type="text" name="artist" value="{{$artist}}"><br>
        <input type="submit" value="追加">
        @csrf
    </form>

    <form action="{{route('logout')}}" method="post">
        <button type="submit">ログアウト</button>
        @csrf
    </form>
</body>
</html>
