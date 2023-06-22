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
    </header>

    <main>
        <div>

        <form action="{{ route('logout') }}" method="post" class="max-w-md mx-auto px-4 py-6 bg-white rounded-md shadow-md">
            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 cursor-pointer">ログアウト</button>
            @csrf
        </form>
        <form action="add_region" method="get">
            <button type="submit">登録地追加</button>
        </form>
        </div>

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

                                $wethers = $areas_data[$area_code]["weathers"];
                                foreach($wethers as $wether){
                                    echo "<td>".$wether . "</td>";
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
