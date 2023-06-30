@php
    use App\Http\Controllers\Controller;
    $message=Controller::get_weather_forecast($data);
@endphp

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>登録地追加（ログイン後）</title>
</head>

<body>
    <header class="border-bottom border-secondary">
        <nav class="navbar navbar-light bg-light">
            <h1>登録地追加</h1>
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
        <div class="select  mt-3 mb-0 mx-3" style="font-size: 22px;">
            都道府県選択
                <form action="add_area" method="POST">
                    <select name="sel_region" class="form-select form-select-lg text-center w-25" aria-label=".form-select-lg example">
                        @foreach($regions as $region)
                            <option value="{{$region -> region_code}}">{{$region -> region_name}}</option>
                        @endforeach
                    </select>
                    <input class="btn btn-info mb-2" type="submit" value="選択">
                    <button type="button" onclick="history.back()" class="btn btn-secondary mb-2">戻る</button>
                    @csrf
                </form>
        </div>

        <div class="now_regions  mt-3 mb-0 mx-3" style="font-size: 22px; padding-left: 382px;">
            <h2 class="pl-3" style="border-left: 8px solid black;">現在の登録地</h2>
            @php
            use App\Models\Region_name;
            foreach ($fav_regions as $fav_region){
                $region_code = $fav_region["region_code"];
                $region = Region_name::where('region_code', "$region_code")->get();
                $region_data = json_decode($region, true);

                foreach ($region_data as $data ){
                    echo "<div class='regions d-inline-block mr-3 mt-2 p-3 border border-secondary rounded-pill'>".$data["region_name"]. "</div>";
                }
            }
            @endphp
        </div>
    </main>
</body>
</html>

