@php
use App\Http\Controllers\Controller;
$message=Controller::getMessage($data);
@endphp

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- BootStrap Link --}}<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    {{-- フォント Link --}}<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster+Two&display=swap" rel="stylesheet">
    {{-- 自作CSSファイル --}}@vite(['resources/css/index_css.css'])
    <title>index</title>
</head>

<body>
    <header class="border-bottom border-1 border-secondary">
        <nav class="navbar navbar-light bg-light">
            <h1 class="Lobster">Temporature</h1>
                <p class="navbar-text mt-3">
                    {{ Auth::user() -> name }} さん {{$message}}
                </p>
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <form action="myplaylist" method="get">
                        <button class="btn btn-primary mr-3" type="submit">マイプレイリスト</button>
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
    <main class="content-container">
        <div style="display: flex; justify-content: space-between;">
            <div class="weather_table" style="margin-right: 10px;">
                <table>
                    <div class="container">
                        <table class="table table-bordered">
                        <thead>
                        <tr class="bg-dark text-white">
                            <th><div class="column_headers">地域名</div></th>
                            <th><div class="column_headers">今日の天気</div></th>
                            <th><div class="column_headers">明日の天気</div></th>
                            <th><div class="column_headers">明後日の天気</div></th>
                            <th><div class="column_headers">削除</div></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $table_data)
                            <?php $area = Controller::areaReplace($table_data); ?>
                            <tr>
                                <td><div class="align-middle text-center areas_name">{{$table_data["prefecture"]}}<br>{{$area}}</div></td>
                                @for ($i=0; $i < 3; $i++)
                                    @if(isset($table_data["weathers"][$i]))
                                        <?php $result = Controller::weatherToIcon($table_data["weathers"][$i]); ?>
                                    @else
                                        <?php $result = "情報取得中"; ?>
                                    @endif
                                    <td class='align-middle text-center weather_forecasts'>{!! $result !!}<br>　</td>
                                @endfor
                                <td class='align-middle text-center delete'><form action='/delete/{{$table_data["id"]}}'><button type='submit' class='btn btn-danger'>削除</botton></form></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div style="flex: 1; margin-left: 10px;">
                <table class="table table-bordered col-12">
                    <tr class="bg-dark text-white">
                        <th><div class="column_headers">ジャケット</div></th>
                        <th><div class="column_headers">曲名</div></th>
                        <th><div class="column_headers">アーティスト</div></th>
                    </tr>
                    @foreach ($data as $fav_region)
                        <?php $results = Controller::weatherTracks($fav_region, $api); ?>
                        @foreach ($results->tracks->items as $counter => $song)
                            @if ($counter > 2)
                                @break
                            @endif
                            <tr>
                                <td class="aimage">
                                    <div class="album_image">
                                        <a href="/information?information={{ $song->id }}"><img src='{{ $song->album->images[0]->url }}' alt="Album Image" height="75.6px"></a>
                                    </div>
                                </td>
                                <td class="align-middle text-center col-6 aid"><b><a href="/information?information={{ $song->id }}">{{ $song->name }}</a></b></td>
                                <td class="align-middle text-center overflow-hidden artist_name"><b>{{ $song->artists[0]->name }}</b></td>
                            </tr>
                        @endforeach
                    @endforeach
                </table>
            <div>
        </div>
    </main>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>



