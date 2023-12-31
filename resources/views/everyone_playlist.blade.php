{{-- 楽曲一覧とみんなのプレイリストの一覧画面 --}}
{{-- 楽曲を一覧として表示する画面がページ1（詳細画面、追加画面に遷移できる） --}}
{{-- みんなのプレイリストの一覧を表示する画面がページ2 (詳細画面に遷移できる） --}}

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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    {{-- フォント Link --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster+Two&display=swap" rel="stylesheet">
    {{-- 自作CSSファイル --}}
    @vite(['resources/css/index_css.css'])
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

    @vite(['resources/css/testcss.css'])
    {{-- @vite(['resources/css/addplaylist_css.css']) --}}
    <title>みんなのプレイリスト</title>
</head>

<body>
    <header class="border-bottom border-1 border-secondary">
        <nav class="navbar navbar-light bg-light">
            <h2 class="Lobster">Temporature</h2>
            <h4>楽曲一覧&みんなのプレイリスト</h4>
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
                    <form action="myplaylist" method="get">
                        <button class="btn btn-primary mr-3" type="submit">マイプレイリスト</button>
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

    <section class="someTabs" data-tabs="">
        <nav class="tabs__nav">
            <a href="#" class="tabs__item active" data-tab="">楽曲一覧</a>
            <a href="#" class="tabs__item" data-tab="">プレイリスト一覧</a>
            <a class="Tabs__presentation-slider" role="presentation"></a>
        </nav>

        <div class="tabs__body" style="text-align: center">
            <div class="tabs__content active" data-tab-content="">
                <div class="container-fluid">
                    <div class="row align-items-center text-center">
                        <div class="col-2">
                            <button class="btn btn-primary d-flex justify-content-center align-items-center material-symbols-outlined" name="back" onclick="location.href=''">
                            楽曲更新
                            <span class="material-symbols-outlined2 align-middle test">
                              refresh
                            </span>
                            </button>
                        </div>
                        <div class="col-8">
                            <form action="" method="GET">
                                <label>
                                    <input type="text" name="keyword" placeholder="検索キーワード">
                                </label>
                                <input type="submit" class="btn btn-primary" value="検索">
                            </form>
                        </div>
                    </div>
                </div>
                <table class="table table-striped text-center align-middle mt-4">
                    <tr class="bg-dark text-white">
                        <th>ジャケット写真</th>
                        <th>曲名</th>
                        <th>アーティスト名</th>
                        <th class="text-center">マイプレイリストへ</th>
                        <th>詳細を表示</th>
                    </tr>
                    @foreach ($results->tracks->items as $song)
                    <tr>
                        <td class="text-center align-middle col-2"><img src="{{$song->album->images[0]->url}}" width=80></td>
                        <td class="text-center align-middle col-3"><b>{{$song->name}}</b></td>
                        <td class="text-center align-middle"><b>{{$song->artists[0]->name}}</b></td>
                        <form action="add_myplaylist" method="get" enctype="multipart/form-data">
                            <td class="text-center align-middle"><button class="btn text-center align-middle btn-secondary" type="submit" name="add_mylist" value='{{$song->id}}'>追加する</button></td>
                        </form>
                        <form action="information" method="get" enctype="multipart/form-data">
                            <td class="text-center align-middle col-2"><button class="btn text-center align-middle btn-info" type="submit" name="information" value='{{$song->id}}'>詳細情報</button></td>
                        </form>
                    </tr>
                    @csrf
                    @endforeach
                </table>
            </div>
            <div class="tabs__content" data-tab-content="">
                <table class="table table-striped text-center align-middle mt-4">
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
    </section>
    <script src="{{ asset('/js/testcss.js') }}"></script>
</body>
</html>
