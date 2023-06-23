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
    <link rel="stylesheet" href="path/to/your/custom.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="#">メインページ</a>
                <p class="navbar-text">
                    {{ Auth::user() -> name }} さん ログイン中
                </p>
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <form action="myplaylist" method="get">
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

    <main>
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th>地域名</th>
                        <th>今日の天気</th>
                        <th>明日の天気</th>
                        <th>明後日の天気</th>
                        <th>削除ボタン</th>
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

                    echo "
                    <tr class='align-middle'>
                    <td>{$prefecture}：{$area}</td>
                    ";

                    $weathers = $areas_data[$area_code]["weathers"];
                    for ($i=0; $i < 3; $i++) {
                        if (isset($weathers[$i])) {
                            $weather = $weathers[$i];
                            $replacements = array(
                                "雨" => "<img src = '".asset('images/normal/rainny.png')."' alt = '雨のイラスト' width = '100px'>",
                                "晴れ" => "<img src = '".asset('images/normal/sunny.png')."' alt = '晴れのイラスト' width = '100px'>",
                                "雷" => "<img src = '".asset('images/normal/thunder.png')."' alt = '雷のイラスト' width = '100px'>",
                                "雪" => "<img src = '".asset('images/normal/snow.png')."' alt = '雪のイラスト' width = '100px'>",
                                "くもり" => "<img src = '".asset('images/normal/cloudy.png')."' alt = 'くもりのイラスト' width = '100px'>",
                            );
                            $result = str_replace(array_keys($replacements), array_values($replacements), $weather);
                            echo "<td align='center' valign='middle'>". $result. "</td>";
                        }else{
                            echo "<td align='center' valign='middle'>情報取得中</td>";
                        }
                    }
                    echo "
                        <td align='center' valign='middle'>
                        <form method='GET' action='/delete/{$id}'>
                            <button type='submit'>削除</button>
                        </form>
                        </td>
                        ";
                }
                @endphp
                </tbody>
            </table>
        </div>
    </main>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
