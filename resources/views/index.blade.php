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
            {{-- <img src="/images/normal/sunny.png" alt="晴れ画像"> --}}
        </nav>

    </header>

    <main>
        <div style="display: flex; justify-content: space-between;">
            <div class="weather_table" style="margin-right: 10px;">
                <table border="1">
                    <tr>
                        <th><div class="column_headers">地域名</div></th>
                        <th><div class="column_headers">今日の天気</div></th>
                        <th><div class="column_headers">明日の天気</div></th>
                        <th><div class="column_headers">明後日の天気</div></th>
                        <th><div class="column_headers">削除</div></th>
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
                                $weathers = $areas_data[$area_code]["weathers"];


                                echo <<<_TABLE_
                                <tr class="align-middle">
                                    <td>
                                        <div class="areas_name">{$prefecture}：{$area}</div>
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
                                            "雨" => "<img src = '".asset('images/normal/rainny.png')."' alt = '雨のイラスト' width = '75px'><br>",
                                            "晴れ" => "<img src = '".asset('images/normal/sunny.png')."' alt = '晴れのイラスト' width = '75px'><br>",
                                            "雷" => "<img src = '".asset('images/normal/thunder.png')."' alt = '雷のイラスト' width = '75px'><br>",
                                            "雪" => "<img src = '".asset('images/normal/snow.png')."' alt = '雪のイラスト' width = '75px'><br>",
                                            "くもり" => "<img src = '".asset('images/normal/cloudy.png')."' alt = 'くもりのイラスト' width = '75px'><br>",
                                            "　" => "",
                                        );
                                        $result = str_replace(array_keys($replacements), array_values($replacements), $weather);
                                        echo "<td align='center' valign='middle'><div class='weather_forecasts'>". $result. "</div></td>";
                                    }else{
                                        echo "<td align='center' valign='middle'><div class='weather_forecasts'>情報取得中</div></td>";
                                    }
                                }
                                echo "<td><div class='delete'><a href='/delete/{$id}'>$id</div></td></tr>";
                            }
                    @endphp

                </table>
            </div>
            <div style="flex: 1; margin-left: 10px;">
                <table border="1">
                    <tr>
                        <th><div class="column_headers">ジャケット</div></th>
                        <th><div class="column_headers">曲名</div></th>
                        <th><div class="column_headers">アーティスト</div></th>
                        <th><div class="column_headers">マイプレイ</div></th>
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
                        $limit = 30;
                        $options = [
                            'limit' => $limit,
                            'offset' => random_int(0,10),
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


                        echo <<<_TABLE_
                        <tr>
                            <td>
                                <div class="album_image"><img src="$albumImage" alt="Album Image" height="98px"></div>
                            </td>
                            <td>
                                <div class="track_name">$trackName</div>
                            </td>
                            <td>
                                <div class="artist_name">$artistName</div>
                            </td>
                            <td>
                                <div class="detail">
                                    <form action="add_myplaylist" method="GET">
                                        <input type="hidden" name="artist_name" value="$artistName">
                                        <input type="hidden" name="song_name" value="$trackName">
                                        <button type="submmit" name="add_mylist" value="add_mylist">リストへ追加</button>
                                        <!--<button type="submmit" name="add_mylist" value="$song->id">リストへ追加</button>-->
                                    </form>
                                </div>
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
    <footer>

    </footer>
</body>
</html>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.areas_name,
.weather_forecasts,
.delete{
    height: 300px;
    font-size: 20px;
}

.column_headers{
    height: 25px;
    overflow: auto;
}

.album_image,
.artist_name,
.detail{
    display: flex;
    justify-content: center;
    align-items: center;
    height: 98px;
    width: 98px;

}

.track_name{
    display: flex;
    justify-content: center;
    align-items: center;
    height: 98px;
    width: 200px;
}


</style>


