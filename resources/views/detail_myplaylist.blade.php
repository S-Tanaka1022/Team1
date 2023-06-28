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

    <form action="" method="get" >
        <label>
            <input type="hidden" name = "playlist_id" value="{{$playlistId}}">
            <input type="text" name="keyword3" placeholder="検索">
        </label>
        <input type="submit" class="btn btn-primary" value="検索">
    </form>


    @if(count($tracks) == 0)
        <p>検索結果は見つかりませんでした</p>
    @else
    <table border='1'>
        <tr>
            <th>ジャケット写真</th>
            <th>曲名</th>
            <th>アーティスト名</th>
            <th>詳細情報</th>
            <th>プレイリストを削除</th>

        </tr>
        @foreach ($tracks as $track)
        <tr class="text-center align-middle">
            <td class="text-center align-middle"><img src="{{$track["detail"]->album->images[0]->url}}" width=80></td>
            <td class="text-center align-middle"><b>{{$track["detail"]->name}}</b></td>
            <td class="text-center align-middle"><b>{{$track["detail"]->artists[0]->name}}</b></td>
            <form action="information" method="get" enctype="multipart/form-data">
                <td class="text-center align-middle"><button class="btn btn-info" type="submit" name="information" value='{{$track["detail"]->id}}'>詳細情報</button></td>
            </form>
            <form action="/delete_myplaylist_song" method="get">
            <input type="hidden" name="playlistId" value="{{$playlist->id}}">
            <td class="text-center align-middle"><button class="btn btn-danger" type="submit" name="song_detail_id" value='{{$track["song_primary_key"]}}'>削除</button></td>
            </form>
        </tr>
        @csrf
        @endforeach
    </table>
    @endif


    <form action="{{route('logout')}}" method="post">
        <button type="submit">ログアウト</button>
        @csrf
    </form>
</body>
</html>
