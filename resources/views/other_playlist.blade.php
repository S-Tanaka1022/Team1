<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$playlist->user->name}}さんのプレイリスト</title>
</head>
<body>
    <h1>{{$playlist->user->name}}さんのプレイリスト</h1>

    {{--
    <div>
        <form action="" method="GET">
            <label>
                検索キーワード
                <input type="text" name="keyword" value="{{ $keyword }}">
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

