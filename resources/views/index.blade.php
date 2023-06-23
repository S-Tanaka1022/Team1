@php
use App\Models\Region_name;
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
        <div>
            <p>
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

                                $weathers = $areas_data[$area_code]["weathers"];
                                foreach($weathers as $weather){
                                    if(isset($weather)){
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
                                echo "<td><a href='/delete/{$id}'>$id</td></tr>";
                                }
                    @endphp

                </table>
            </p>
        </div>
    </main>
    <footer>

    </footer>
</body>
</html>
