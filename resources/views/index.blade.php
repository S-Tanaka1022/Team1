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
</head>

<body>
    <header>
        <h1>index.blade.php</h1>
        <p>
            {{ Auth::user() -> name }} さんログイン中
        </p>
        <nav style="background-color: #cdd9e4; padding: 10px;">
            <form action="myplaylist" method="get" style="display: inline-block;">
                <button type="submit">プレイリスト</button>
            </form>
            <form action="everyone_playlist" method="get" style="display: inline-block;">
                <button type="submit">みんなのプレイリスト</button>
            </form>
            <form action="add_region" method="get" style="display: inline-block;">
                <button type="submit">登録地追加</button>
            </form>
            <form action="{{ route('logout') }}" method="post" style="display: inline-block; margin-right: 10px;">
                @csrf
                <button type="submit">ログアウト</button>
            </form>

        </nav>

    </header>

    <main>
        <div>
            <p>

                <table border="0">
                <tr>

                <td>
                <table border="1">
                    <tr>
                        <th>地域名</th>
                        <th>今日の天気</th>
                        <th>明日の天気</th>
                        <th>明後日の天気</th>
                        <th>削除</th>
                    </tr>

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

                                echo <<<_TABLE_
                                <tr class="align-middle">
                                    <td>{$prefecture}：{$area}</td>
_TABLE_;

                                $wethers = $areas_data[$area_code]["weathers"];
                                
                                foreach($wethers as $wether){
                                    echo "<td>".$wether . "</td>";

                                    // 曲の検索
                                    $query = "track:$wether";
                                    $results = $api->search($query, 'artist');

                                    // 検索結果から曲の情報を取得
                                    $songs = $results->artists->items;
                                    var_dump($songs);
                        
                                }

                                echo "<td><a href='/delete/{$id}'>$id</td></tr>";
                            }
                    @endphp

                </table>
                </td>

                <td>
                <table border="1">
                    @foreach ($songs as $counter => $song)
                        <?php 
                        if ($counter > 2) {
                            break;
                        }
                        $trackName = $song->name;
                        $artistName = $song->artists[0]->name;
                        $albumImage = $song->album->images[0]->url;
                        ?>
                    <tr>
                        <td><img src="{{ $albumImage }}" alt="Album Image"></td>
                        <td>{{ $trackName }}</td>
                        <td>{{ $artistName }}</td>
                        <td>
                        <form action="add_myplaylist" method="GET">
                        @csrf
                        <input type="hidden" name="artist_name" value="{{ $artistName }}">
                        <input type="hidden" name="song_name" value="{{ $trackName }}">
                        <button type="submmit" name="add_mylist" value="add_mylist">リストへ追加</button>
                        <!--<button type="submmit" name="add_mylist" value="{{$song->id}}">リストへ追加</button>-->
                        </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
                </td>

                </tr>
                </table>
            </p>
        </div>
    </main>
    <footer>

    </footer>
</body>
</html>
