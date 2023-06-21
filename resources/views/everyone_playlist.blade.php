<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>みんなのプレイリスト</title>
</head>
<body>
    <h1>みんなのプレイリスト</h1>

    <div>
        <form action="" method="GET">
            <label>
                検索キーワード
                <input type="text" name="keyword" value="{{ $keyword }}">
            </label>
            <input type="submit" value="検索">
        </form>
    </div>

    <div>
        <form action="" method="GET">
            <button type="button" name="add_list" value="add_list">プレイリスト作成</button>
        </form>
    </div>

    <table border='1'>
        <tr>
            <th>user</th>
            <th>playlist</th>
            <th>詳細</th>
        </tr>
        @foreach ($playlists as $playlist)
            <tr>
                <td>{{$playlist->name}}</td>
                <td>{{$playlist->playlist}}</td>
                <td><a href="/other_playlist">詳細</a></td>
            </tr>
        @endforeach
    </table>

    <form action="{{route('logout')}}" method="post">
        <button type="submit">ログアウト</button>
        @csrf
    </form>
</body>
</html>
