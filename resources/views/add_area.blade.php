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
                            @php
                                $area = $areas['area']['name'];
                                $replace_area = array(
                                    "地方" => "地域",
                                    );
                                $area = str_replace(array_keys($replace_area), array_values($replace_area), $area);
                            @endphp
                            <option value="{{$i}}">{{$area}}</option>
                            {{-- エリアコードをエリアごとに変化させ、送信 --}}
                            {{$i+=1}}
                        @endforeach
                    </select>
                <input class="btn btn-info mb-2" type="submit" value="追加">
                <button type="button" onclick="history.back()" class="btn btn-secondary mb-2">戻る</button>
            @csrf
            </form>
        </div>

        <div class="now_areas mt-3 mb-0 mx-3 pl-6" style="font-size: 22px; padding-left: 382px;">
            <h2 class="pl-3" style="border-left: 8px solid black;">現在の登録地</h2>
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
                    echo "<div class='areas d-inline-block mr-3 mt-2 p-3 border border-secondary rounded-pill'>".$data["region_name"]."：".$areasdata[$area_code]["area"]["name"]. "</div>";
                }
            }
            @endphp
        </div>
    </main>
</body>
</html>
