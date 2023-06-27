@php
use App\Models\Region_name;

use SpotifyWebAPI\SpotifyWebAPI;
use SpotifyWebAPI\Session;

// Spotify APIクライアントの初期化
$session = new Session(
    'f172da853aeb4266863fb2661addbb76',
    'bcf72a943e1245828831cda721f77987'
);
$session->requestCredentialsToken();
$accessToken = $session->getAccessToken();

$api = new SpotifyWebAPI();
$api->setAccessToken($accessToken);

$songs;



@endphp

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>index</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- 自作CSSファイル -->
    @vite(['resources/css/index_css.css'])
</head>

<body>
    <header>
        <nav class="navbar navbar-light bg-light">
            <h1>Temporature</h1>
                <p class="navbar-text mt-3">
                    {{ Auth::user() -> name }} さん ログイン中
                </p>
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <form action="myplaylists" method="get">
                        <button class="btn btn-primary" type="submit">プレイリスト</button>
                    </form>
                </li>
                <li class="nav-item">
                    <form action="everyone_playlist" method="get">
                        <button class="btn btn-primary" type="submit">みんなのプレイリスト</button>
                    </form>
                </li>
                <li class="nav-item">
                    <form action="add_region" method="get">
                        <button class="btn btn-primary" type="submit">登録地追加</button>
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
                <table border="1">
                <div class="container">
                    <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th><div class="column_headers">地域名</div></th>
                        <th><div class="column_headers">今日の天気</div></th>
                        <th><div class="column_headers">明日の天気</div></th>
                        <th><div class="column_headers">明後日の天気</div></th>
                        <th><div class="column_headers">削除</div></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                #表示するのは、都道府県名（DB）・地域名(API)・気象情報(API)
                foreach ($fav_regions as $fav_region){
                    $region_code = $fav_region["region_code"];
                    $area_code = $fav_region["area_code"];
                    $id = $fav_region["id"];

                    $region = Region_name::where('region_code', "$region_code")->get();
                    $region_data = json_decode($region, true);
                    $prefecture = $region_data[0]["region_name"];

                                $url = "https://www.jma.go.jp/bosai/forecast/data/forecast/{$region_code}.json";
                                $response = file_get_contents($url);
                                $data = json_decode($response, true);
                                $areas_data = $data[0]["timeSeries"][0]["areas"];
                                $area = $areas_data[$area_code]["area"]["name"];
                                $weathers = $areas_data[$area_code]["weathers"];


                                echo <<<_TABLE_
                                <tr>
                                    <td>
                                        <div class="areas_name">{$prefecture}<br>{$area}</div>
                                    </td>
_TABLE_;

                                /* 追加してほしいところ
                                {{-- $weathers = $areas_data[$area_code]["weathers"]; --}}
                                {{-- 曲の検索 --}}
                                {{-- $query =  $weathers[0]; --}}
                                {{-- dump($weathers[0]); --}}
                                {{-- $options = ['limit'=>3]; --}}
                                {{-- $results = $api->search($query, 'track', $options); --}}
                                {{-- 検索結果から曲の情報を取得 --}}
                                {{-- $songs = $results->tracks->items; --}}
                                foreach($weathers as $weather){
                                    echo "<td>".$weather . "</td>";
                                }
                                echo "<td><a href='/delete/{$id}'>$id</td></tr>";
                                */



                                for ($i=0; $i < 3; $i++) {
                                    if (isset($weathers[$i])) {
                                        $weather = $weathers[$i];
                                        $replacements = array(
                                            "雨" => "<img src = '".asset('images/normal/rainny.png')."' alt = '雨のイラスト' width = '50px'><br>",
                                            "晴れ" => "<img src = '".asset('images/normal/sunny.png')."' alt = '晴れのイラスト' width = '50px'><br>",
                                            "雷" => "<img src = '".asset('images/normal/thunder.png')."' alt = '雷のイラスト' width = '50px'><br>",
                                            "雪" => "<img src = '".asset('images/normal/snow.png')."' alt = '雪のイラスト' width = '50px'><br>",
                                            "くもり" => "<img src = '".asset('images/normal/cloudy.png')."' alt = 'くもりのイラスト' width = '50px'><br>",
                                            "　" => "",
                                            "所により" => "",
                                            "では" => "では<br>",
                                        );
                                        $result = str_replace(array_keys($replacements), array_values($replacements), $weather);
                                        echo "<td class='align-middle text-center weather_forecasts'>". $result. "</td>";
                                    }else{
                                        echo "<td class='align-middle text-center weather_forecast'>情報取得中</td>";
                                    }
                                }
                                echo "<td class='align-middle text-center delete><form action='/delete/{$id}'><input type='submit' value='削除'></form></td></tr>";
                            }
                    @endphp

                </table>
            </div>
            <div style="flex: 1; margin-left: 10px;">
                <table border="1" class="table table-bordered">
                    <tr>
                        <th><div class="column_headers">ジャケット</div></th>
                        <th><div class="column_headers">曲名</div></th>
                        <th><div class="column_headers">アーティスト</div></th>
                    </tr>

                    @php
                    foreach ($fav_regions as $fav_region){
                        $region_code = $fav_region["region_code"];
                        $area_code = $fav_region["area_code"];
                        $id = $fav_region["id"];

                        $region = Region_name::where('region_code', "$region_code")->get();
                        $region_data = json_decode($region, true);
                        $prefecture = $region_data[0]["region_name"];

                        $url = "https://www.jma.go.jp/bosai/forecast/data/forecast/{$region_code}.json";
                        $response = file_get_contents($url);
                        $data = json_decode($response, true);
                        $areas_data = $data[0]["timeSeries"][0]["areas"];
                        $weathers = $areas_data[$area_code]["weathers"];
                            // 曲の検索
                        $search_word = preg_split('/\p{Zs}/u', $weathers[0], 2)[0];
                        if($search_word=="くもり")
                        {
                            $search_word="曇";
                        }
                        $limit = 3;
                        $options = [
                            'limit' => $limit,
                            'offset' => random_int(0,100),
                        ];
                        $results = $api->search($search_word, 'track',$options);

                        // 検索結果から曲の情報を取得
                        $songs = $results->tracks->items;


                        foreach ($songs as $counter => $song){
                            if ($counter > 2) {
                                break;
                            }
                            $trackName = $song->name;
                            $artistName = $song->artists[0]->name;
                            $albumImage = $song->album->images[0]->url;
                            $songId = $song->id;
                            // @dump($song);


                        echo <<<_TABLE_
                            <tr>
                                <td class="aimage">
                                    <div class="album_image">
                                        <a href="/information?information={$songId}">
                                            <img src="$albumImage" alt="Album Image" height="75.6px">
                                        </a>
                                    </div>
                                </td>
                                <td class="align-middle text-center aid">
                                        <a href="/information?information={$songId}">
                                            $trackName
                                        </a>
                                </td>
                                <td class='align-middle text-center artist_name'>
                                    $artistName
                                </td>
                            </tr>
_TABLE_;
                    }
                }
            @endphp

                </table>
            <div>


        </div>
    </main>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>



