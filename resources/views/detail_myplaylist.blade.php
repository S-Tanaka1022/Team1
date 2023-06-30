<?php
    use App\Http\Controllers\Controller;
    $message=Controller::get_weather_forecast($data);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>プレイリスト：{{$playlist->list_name}}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    {{-- フォント Link --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster+Two&display=swap" rel="stylesheet">
    {{-- 自作CSSファイル --}}
    @vite(['resources/css/index_css.css'])

</head>
<body>
    <header class="border-bottom border-1 border-secondary">
        <nav class="navbar navbar-light bg-light">
            <h2 class="Lobster">Temporature</h2>
            <h4>プレイリスト：{{$playlist->list_name}}</h4>
                <p class="navbar-text mt-3">
                    {{$message}}
                </p>
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <form action="index" method="get">
                        <button class="btn btn-primary mr-3" type="submit">ホーム</button>
                    </form>
                </li>
                <li class="nav-item">
                    <form action="everyone_playlist" method="get">
                        <button class="btn btn-primary mr-3" type="submit">楽曲一覧</button>
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-2">
                    <main class="m-3 text-left">
                        <form action="myplaylist">
                            <button class="btn btn-info" onclick="">
                                <b>戻る</b>
                        </form>
                    </button>
                </div>
                <div class="col-5  ofset-3 text-right m-3">
                    <form action="" method="get" >
                        <label>
                            <input type="hidden" name = "playlist_id" value="{{$playlistId}}">
                            <input type="text" name="keyword3" placeholder="検索キーワード">
                        </label>
                        <input type="submit" class="btn btn-primary" value="検索">
                    </form>
                </div>
            </div>
        </div>
        @if(count($tracks) == 0)
            <p>検索結果は見つかりませんでした</p>
        @else
        <table class="table table-striped text-center align-middle">
            <tr class="bg-dark text-white">
                <th>ジャケット写真</th>
                <th>曲名</th>
                <th>アーティスト名</th>
                <th>詳細情報</th>
                <th>曲を削除</th>
            </tr>
            @foreach ($tracks as $track)
            <tr>
                <td class="text-center align-middle col-2"><img src="{{$track["detail"]->album->images[0]->url}}" width=80></td>
                <td class="text-center align-middle col-3"><b>{{$track["detail"]->name}}</b></td>
                <td class="text-center align-middle"><b>{{$track["detail"]->artists[0]->name}}</b></td>
                <form action="information" method="get" enctype="multipart/form-data">
                    <td class="text-center align-middle"><button class="btn align-middle btn-info" type="submit" name="information" value='{{$track["detail"]->id}}'>詳細情報</button></td>
                </form>
                <form action="/delete_myplaylist_song" method="get">
                    <input type="hidden" name="playlistId" value="{{$playlist->id}}">
                    <td class="text-center align-middle col-2"><button class="btn text-center align-middle btn-danger" type="submit" name="song_detail_id" value='{{$track["song_primary_key"]}}'>削除</button></td>
                </form>
            </tr>
            @csrf
            @endforeach
        </table>
        @endif
</body>
</html>
