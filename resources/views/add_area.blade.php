@php
    $i=0;
@endphp

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    @vite(['resources/css/region_area.css'])
    <title>エリア追加画面</title>
</head>
<body>
    <header class="border-bottom border-1 border-secondary">
        <nav class="navbar navbar-light bg-light">
            <h1>エリア選択画面</h1>
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
                    <form action="myplaylists" method="get">
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
        <div class="select">
            エリア選択
            <form action="code_save" method="POST">
                <input type="hidden" name="region_code" value="{{$region_code}}">
                <select name="sel_area_code" class="form-select form-select-lg mb-3 text-center" aria-label=".form-select-lg example">
                    @foreach($areas_data as $areas)
                        <option value="{{$i}}">{{$areas['area']['name']}}</option>
                        {{-- エリアコードをエリアごとに変化させ、送信 --}}
                        {{$i+=1}}
                    @endforeach
                </select>
                <input class="btn btn-info mb-2" type="submit" value="追加">
                <button type="button" onclick="history.back()" class="btn btn-secondary mb-2">戻る</button>
            @csrf
            </form>
        </div>

        <div class="now_areas">
            <h2 class="border-left-2 border-dark ps-4">現在の登録地</h2>
            @php
            use App\Models\Region_name;
            foreach ($fav_regions as $fav_region){
                $region_code = $fav_region["region_code"];
                $area_code = $fav_region["area_code"];
                $region = Region_name::where('region_code', "$region_code")->get();
                $region_data = json_decode($region, true);

                $url = "https://www.jma.go.jp/bosai/forecast/data/forecast/{$region_code}.json";
                $response = file_get_contents($url);
                $data = json_decode($response, true);
                $areasdata = ($data[0]["timeSeries"][0]["areas"]);

                foreach ($region_data as $data ){
                    // echo $areasdata[0]["area"]["name"];
                    echo "<div class='areas float-start me-2 mt-2 p-3 border border-dark rounded-pill'>".$data["region_name"]."：".$areasdata[$area_code]["area"]["name"]. "</div>";
                }
            }
            @endphp
        </div>
    </main>
</body>
</html>
