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
    <header>
        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="#">エリア選択画面</a>
                <p class="navbar-text">
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
                    <form action="everyone_playlist" method="get">
                        <button class="btn btn-primary" type="submit">みんなのプレイリスト</button>
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
        エリア選択
        <form action="code_save" method="POST">
            <input type="hidden" name="region_code" value="{{$region_code}}">
            <select name="sel_area_code">
                @foreach($areas_data as $areas)
                    <option value="{{$i}}">{{$areas['area']['name']}}</option>
                    {{-- エリアコードをエリアごとに変化させ、送信 --}}
                    {{$i+=1}}
                @endforeach
            </select>
        <input type="submit" value="追加">
        @csrf
        </form>
        <div>
            <h1>現在の登録地</h1>
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
                    echo "<p>".$data["region_name"]."：".$areasdata[$area_code]["area"]["name"]. "</p>";
                }
            }
            @endphp
        </div>
    </main>
</body>
</html>
