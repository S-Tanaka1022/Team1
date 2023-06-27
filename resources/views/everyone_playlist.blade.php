<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <title>みんなのプレイリスト</title>
        <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body>
    <header>
        <nav class="navbar navbar-light bg-light">
            <h1>楽曲一覧&みんなのプレイリスト</h1>
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
                    <form action="myplaylists" method="get">
                        <button class="btn btn-primary" type="submit">マイプレイリスト</button>
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

    <p id="tabcontrol" class="ml-5">
        <a href="#tabpage1">楽曲一覧</a>
        <a href="#tabpage2">プレイリスト一覧</a>
     </p>

     <div id="tabbody"class="m-3">
        <div id="tabpage1" class="m-4">
            <div class="container align-middle text-center">
                <div class="row align-items-center text-center">
                    <div class="col-2">
                        <button class="btn btn-primary btn-block" name="back" onclick="location.href=''">
                            楽曲更新
                        </button>
                    </div>
                    <div class="col-8">
                        <form action="" method="GET">
                            <label>
                                検索キーワード
                                <input type="text" name="keyword" placeholder="検索">
                            </label>
                            <input type="submit" class="btn btn-primary" value="検索">
                        </form>
                    </div>
                </div>
            </div>

            <table class="table text-center align-middle">
                <tr class="bg-dark text-white">
                    <th>ジャケット写真</th>
                    <th>曲名</th>
                    <th>アーティスト名</th>
                    <th class="text-right">プレリストに追加</th>
                    <th>詳細を表示</th>
                </tr>
                @foreach ($results->tracks->items as $song)
                <tr>
                    <td class="text-center align-middle col-2"><img src="{{$song->album->images[0]->url}}" width=80></td>
                    <td class="text-center align-middle"><b>{{$song->name}}</b></td>
                    <td class="text-center align-middle"><b>{{$song->artists[0]->name}}</b></td>
                    <form action="add_myplaylist" method="get" enctype="multipart/form-data">
                        <td class="text-right align-middle col-3"><button class="btn text-center align-middle btn-secondary" type="submit" name="add_mylist" value='{{$song->id}}'>リストへ追加</button></td>
                    </form>
                    <form action="information" method="get" enctype="multipart/form-data">
                        <td class="text-center align-middle col-2"><button class="btn text-center align-middle btn-info" type="submit" name="information" value='{{$song->id}}'>詳細情報</button></td>
                     </form>
                </tr>
                @csrf
                @endforeach
            </table>

        </div>



        <div id="tabpage2">
                <form action="" method="GET">
                    <label>
                        <input class="col-12" type="text" name="keyword2" placeholder="検索"  onclick="showTab('tabpage2'); return false;">
                    </label>
                    <input type="submit" value="検索" class="btn btn-primary">
                </form>

            <table class="table text-center align-middle">
                <tr class="bg-dark text-white">
                    <th>ユーザ名</th>
                    <th>プレイリスト名</th>
                    <th>詳細</th>
                </tr>

                @foreach ($playlists as $playlist)
                    <tr>
                        <td class="text-center align-middle"><b>{{$playlist->user->name}}</b></td>
                        <td class="text-center align-middle"><b>{{$playlist->list_name}}</b></td>

                        <form action="other_playlist" method="get" enctype="multipart/form-data">
                            <td class="text-center align-middle"><button type="submit" name="playlist_id" value='{{$playlist->id}}' class="btn btn-info">詳細</button></td>
                            @csrf
                        </form>
                    </tr>
                @endforeach
            </table>
        </div>
     </div>
    <script src="{{ asset('/js/test.js') }}"></script>
</body>
</html>
