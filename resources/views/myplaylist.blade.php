<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>マイプレイリスト</title>
</head>

<body>
    <h1>マイプレイリスト</h1>
    
    <div>
        <form action="" method="GET">
            <label>
                検索キーワード
                <input type="text" name="keyword2">
            </label>
            <input type="submit" value="検索">
        </form>
    </div>


    <form action="" method="GET">
        <button type="button" name="weather" value="weather" onclick="location.href='/index'">天気情報</button>
    </form>
    <form action="" method="GET">
        <button type="button" name="mylist" value="mylist" onclick="location.href='/everyone_playlist'">みんなのプレイリスト</button>
    </form>
    <form action="{{route('logout')}}" method="post">
        <button type="submit">ログアウト</button>
        @csrf
    </form>

    <table border='1'>
        <tr>
            <th>プレイリスト名</th>
            <th>詳細を表示</th>
            <th>プレイリストを削除</th>
        </tr>
        @foreach ($playlists as $playlist)
        <tr>
            <td>{{$playlist->list_name}}</td>
            <form action="detail_myplaylist" method="get" enctype="multipart/form-data">
                <td><button type="submit" name="playlist_id" value='{{$playlist->id}}'>詳細</button></td>
                 @csrf
            </form>
            <form>
            <td><button type="submit" name="" value="">削除</button></td>
            </form>
        </tr>
        @endforeach
    </table>

</body>

</html>