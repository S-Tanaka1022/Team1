<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>プレイリスト：{{$playlist->list_name}}</title>
</head>
<body>
    <h1>プレイリスト：{{$playlist->list_name}}</h1>
    {{--
    <div>
        <form action="" method="GET">
            <label>
                検索キーワード
                <input type="text" name="keyword">
            </label>
            <input type="submit" value="検索">
        </form>
    </div>
    --}}

    <table border='1'>
        <tr>
            <th>ジャケット写真</th>
            <th>曲名</th>
            <th>アーティスト名</th>
            <th>詳細情報</th>
            <th>プレイリストを削除</th>

        </tr>
        @foreach ($tracks as $track)
        <tr>
            <td><img src="{{$track->album->images[0]->url}}" width=80></td>
            <td>{{$track->name}}</td>
            <td>{{$track->artists[0]->name}}</td>
            <form action="information" method="get" enctype="multipart/form-data">
                <td><button type="submit" name="information" value='{{$track->id}}'>詳細情報</button></td>
            </form>
            <form action="delete_myplaylist_song" method="get">
            <input type="hidden" name="$playlistId" value="{{$playlist->id}}">
            <td><button type="submit" name="song_detail_id" value='{{$track->id}}'>削除</button></td>
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
