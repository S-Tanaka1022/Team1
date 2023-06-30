@php
    use App\Http\Controllers\Controller;
    $i=0;
    $message=Controller::get_weather_forecast($data);
@endphp

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
    <title>エリア追加画面</title>
</head>
<body>
    <header class="border-bottom border-1 border-secondary">
        <nav class="navbar navbar-light bg-light">
            <h2 class="Lobster">Temporature</h2>
            <h4>エリア選択画面</h4>
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
                    <form action="everyone_playlist" method="get">
                        <button class="btn btn-primary mr-3" type="submit">みんなのプレイリスト</button>
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

    <main>
        <div class="select mt-3 mb-0 mx-3" style="font-size: 22px;">
            エリア選択
            <form action="code_save" method="POST">
                <input type="hidden" name="region_code" value="{{$region_code}}">
                    <select name="sel_area_code" class="form-select form-select-lg text-center w-25" aria-label=".form-select-lg example">
                        @foreach($areas_data as $areas)
                            <?php $area = Controller::replaceWord($areas); ?>
                            <option value="{{$i}}">{{$area}}</option>
                            {{$i+=1}}
                        @endforeach
                    </select>
                <input class="btn btn-info mb-2" type="submit" value="追加">
                <button type="button" onclick="history.back()" class="btn btn-secondary mb-2">戻る</button>
            @csrf
            </form>
        </div>

        <div class="now_areas mt-3 mb-0 mx-3 pl-6" style="font-size: 22px; padding-left: 382px;">
            <h4 class="pl-3" style="border-left: 8px solid black;">現在の登録地</h4>
            @foreach ($fav_regions as $fav_region)
                <?php [$areas_data, $region_data, $area_code]=Controller::getAreaData($fav_region); ?>
                @foreach ($region_data as $data )
                    <div class='areas d-inline-block mr-3 mt-2 p-3 border border-secondary rounded-pill'>{{$data["region_name"]}}：{{$areas_data[$area_code]["area"]["name"]}}</div>
                @endforeach
            @endforeach
        </div>
    </main>
</body>
</html>
