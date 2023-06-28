<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>プレイリスト：{{$playlist->list_name}}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body>
    <header class="border-bottom border-1 border-secondary">
        <nav class="navbar navbar-light bg-light">
            <h1>プレイリスト：{{$playlist->list_name}}</h1>
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
    <main class="m-3">
        <button class="btn btn-info btn-block btn-lg" onclick="goBack()">
            <b>戻る</b>
        </button>

        <script>
        function goBack() {
        window.history.back();
        }
        </script>
        <form action="" method="get" >
            <label>
                <input type="hidden" name = "playlist_id" value="{{$playlistId}}">
                <input type="text" name="keyword3" placeholder="検索キーワード">
            </label>
            <input type="submit" class="btn btn-primary" value="検索">
        </form>
    <div class="container">
        <div class="row">
            <div class="col-2">
                <main class="m-2 text-left">
                    <button class="btn btn-info" onclick="goBack()">
                        <b>戻る</b>
                    </button>

                    <script>
                    function goBack() {
                    window.history.back();
                    }
                    </script>
                </div>
                <div class="col-9 text-right m-3">
                    <form action="" method="get" >
                        <label>
                            <input type="hidden" name = "playlist_id" value="{{$playlistId}}">
                            <input type="text" name="keyword3" placeholder="検索">
                        </label>
                        <input type="submit" class="btn btn-primary" value="検索">
                    </form>
                </div>
            </div>
        </div>
    </div>

        @if(count($tracks) == 0)
            <p>検索結果は見つかりませんでした</p>
        @else
        <table class="table table-striped">
            <tr class="bg-dark text-white text-center align-middle">
                <th>ジャケット写真</th>
                <th>曲名</th>
                <th>アーティスト名</th>
                <th>詳細情報</th>
                <th>曲を削除</th>

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
    </main>
</body>
</html>
