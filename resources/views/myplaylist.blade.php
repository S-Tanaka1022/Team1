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
    <title>マイプレイリスト</title>
</head>

<body>
    <header class="border-bottom border-1 border-secondary">
        <nav class="navbar navbar-light bg-light">
            <h2 class="Lobster">Temporature</h2>
            <h4>マイプレイリスト</h4>
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
    <main class="m-3">
        <div style="text-align: center">
            <form action="" method="GET">
                <label>
                    <input type="text" name="keyword2" placeholder="検索キーワード">
                </label>
                <input type="submit" value="検索" class="btn btn-primary">
            </form>
        </div>
        <table class="table table-striped mt-3">
            <tr class="bg-dark text-white text-center align-center">
                <th>プレイリスト名</th>
                <th>詳細を表示</th>
                <th>プレイリストを削除</th>
            </tr>
            @foreach ($playlists as $playlist)
            <tr class="text-center align-middle">
                    <td>
                        <b>{{$playlist->list_name}}</b>
                    </td>
                <form action="detail_myplaylist" method="get" enctype="multipart/form-data">
                    <td>
                        <button class="btn btn-info" type="submit" name="playlist_id" value='{{$playlist->id}}'>詳細</button>
                    </td>
                    @csrf
                </form>
                <form action="delete_myplaylist" method="get">
                <td>
                    <button class="btn btn-danger" type="submit" name="playlist_id" value="{{$playlist->id}}" onclick="return confirmDelete()">削除</button>
                </td>
                </form>

                <script>
                function confirmDelete() {
                    return confirm("本当に削除してもよろしいですか？");
                }
                </script>
            </tr>
            @endforeach
        </table>
    </main>
</body>

</html>
