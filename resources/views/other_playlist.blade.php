{{-- みんなのプレイリスト一覧画面から「詳細」ボタンを押したときに来る画面 --}}
{{-- 楽曲一覧と構成は一緒でリストへ追加と楽曲詳細に遷移できる --}}
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

    <title>{{$playlist->user->name}}さんのプレイリスト</title>
</head>
<body>
    <header class="border-bottom border-1 border-secondary">
        <nav class="navbar navbar-light bg-light">
            <h1>{{$playlist->user->name}}さんのプレイリスト</h1>
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
            <div class="row" >
                <div class="col-2">
                    <main class="m-3 text-left">
                    <button class="btn btn-info btn" onclick="goBack()">
                        <b>戻る</b>
                    </button>
                    <script>
                        function goBack() {
                            window.history.back();
                        }
                    </script>
                </div>
                <div class="col-5  ofset-3 text-right m-3">
                    <form action="" method="get">
                      <label>
                        <input type="hidden" name="playlist_id" value="{{$playlistId}}">
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
            <tbody class="m-3">
                <tr class="bg-dark text-white m-3">
                    <th>ジャケット写真</th>
                    <th>曲名</th>
                    <th>アーティスト名</th>
                    <th>マイプレイリストへ</th>
                    <th>詳細情報</th>

                </tr>
                @foreach ($tracks as $track)
                <tr class="text-center align-middle">
                    <td class="text-center align-middle col-2"><img src="{{$track->album->images[0]->url}}" width=80></td>
                    <td class="text-center align-middle"><b>{{$track->name}}</b></td>
                    <td class="text-center align-middle"><b>{{$track->artists[0]->name}}</b></td>
                    <form action="add_myplaylist" method="get" enctype="multipart/form-data">
                        <td class="text-center align-middle col-2"><button class="btn text-center align-middle btn-secondary" type="submit" name="add_mylist" value='{{$track->id}}'>追加する</button></td>
                    </form>
                    <form action="information" method="get" enctype="multipart/form-data">
                        <td class="text-center align-middle col-2"><button class="btn text-center align-middle btn-info" type="submit" name="information" value='{{$track->id}}'>詳細情報</button></td>
                    </form>
                </tr>
                @csrf
                @endforeach
            </tr>
        </table>
        @endif
</body>
</html>

