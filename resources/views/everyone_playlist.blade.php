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
    <form action="" method="GET">
        <button type="button" name="weather" value="weather" onclick="location.href='/index'">天気情報</button>
    </form>
    <form action="" method="GET">
        <button type="button" name="mylist" value="mylist" onclick="location.href='/myplaylist'">マイプレイリスト</button>
    </form>
    <form action="{{route('logout')}}" method="post">
        <button type="submit">ログアウト</button>
        @csrf
    </form>

    <p id="tabcontrol">
        <a href="#tabpage1">楽曲一覧</a>
        <a href="#tabpage2">プレイリスト一覧</a>
     </p>

     <div id="tabbody">
        <div id="tabpage1">
            <div>
                <form action="" method="GET">
                    <label>
                        検索キーワード
                        {{-- <input type="text" name="keyword" value="{{$keyword}}"> --}}
                    </label>
                    <input type="submit" value="検索">
                </form>
            </div>

            <table border='1'>
                <tr>
                    <th>ジャケット写真</th>
                    <th>曲名</th>
                    <th>アーティスト名</th>
                    <th>プレリストに追加</th>
                    <th>詳細を表示</th>
                </tr>
                @foreach ($results->tracks->items as $song)
                <form action="add_myplaylist" method="GET" enctype="multipart/form-data">
                    <tr>
                        <td><img src="{{$song->album->images[0]->url}}" width=80></td>
                        <td>{{$song->name}}</td>
                        <td>{{$song->artists[0]->name}}</td>
                        <td><button type="submit" name="add_mylist" value="add_mylist">リストへ追加</button></td>
                        <input type="hidden" name="artist_name" value='{{$song->artists[0]->name}}''>
                        <input type="hidden" name="song_name" value='{{$song->name}}'>
                        <td><a href="/other_playlist">詳細</a></td>
                    </tr>
                </form>
                @endforeach
            </table>


            {{--▼ プレイリスト追加へのページ遷移（仮） ▼--}}
            <form action="" method="GET">
                <button type="button" name="add_mylist" value="add_mylist" onclick="location.href='/add_myplaylist'">リストへ追加</button>
            </form>
            {{--▲ プレイリスト追加へのページ遷移（仮） ▲--}}

        </div>



        <div id="tabpage2">
            <div>
                <form action="" method="GET">
                    <label>
                        検索キーワード
                        {{-- <input type="text" name="keyword" value="{{$keyword}}"> --}}
                    </label>
                    <input type="submit" value="検索">
                </form>
            </div>

            <table border='1'>
                <tr>
                    <th>user</th>
                    <th>playlist</th>
                    <th>詳細</th>
                </tr>
                {{--
                @foreach ($playlists as $playlist)
                    <tr>
                        <td>{{$playlist->name}}</td>
                        <td>{{$playlist->playlist}}</td>
                        <td><a href="/other_playlist">詳細</a></td>
                    </tr>
                @endforeach
                --}}
            </table>
        </div>
     </div>

    <script src="{{ asset('/js/everyone_playlist.js') }}"></script>
</body>
</html>
