@php
// 東京の現在の天気　overview
// POSTで送られてきたエリアコードをurlに挿入
$url1 = 'https://www.jma.go.jp/bosai/forecast/data/overview_forecast/130000.json';
$response1 = file_get_contents($url1);
$data1 = json_decode($response1, true);

// 東京の天気詳細
// POSTで送られてきたエリアコードをurlに挿入
$url2 = 'https://www.jma.go.jp/bosai/forecast/data/forecast/130000.json';
$response2 = file_get_contents($url2);
$data2 = json_decode($response2, true);

$areasdata = ($data2[0]["timeSeries"][0]["areas"]);
// $data2[0:固定][timeSeries:固定][0:地域によって変化する]
// @dump($areasdata["area"]);
foreach ($areasdata as $key => $data) {
    $area = $data["area"];
    $weatherCodes = $data["weatherCodes"];
    $weathers = $data["weathers"];
    $winds = $data["winds"];
    $waves = $data["waves"];
}

//     echo $area["name"] . "の天気<hr>";

//     foreach ($weatherCodes as $key => $weatherCode) {
//         echo $key + 1 . "番目の天気コード：" . $weatherCode . "<br>";
//     }
//     echo "<hr>";

//     foreach ($weathers as $key => $weather) {
//         echo $key + 1 . "番目の天気：" . $weather . "<br>";
//     }
//     echo "<hr>";

//     foreach ($winds as $key => $wind) {
//         echo $key + 1 . "番目の風向き：" . $wind . "<br>";
//     }
//     echo "<hr>";

//     foreach ($waves as $key => $wave) {
//         echo $key + 1 . "番目の風速：" . $wave . "<br>";
//     }
//     echo "<hr>";
//     }

// echo "天気予報over view";
// @dump($data1);

echo "天気予報詳細";
@dump($data2);

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

        </div>
        <form action="{{ route('logout') }}" method="post" class="max-w-md mx-auto px-4 py-6 bg-white rounded-md shadow-md">
            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 cursor-pointer">ログアウト</button>
            @csrf
        </form>

        <div>
            <p>
                <table border="1">
                    <tr>
                        <th>地域名</th>
                        <th>今日の天気</th>
                        <th>明日の天気</th>
                        <th>明後日の天気</th>
                    </tr>

                    <tr class="align-middle">
                        {{-- 地方名 --}}
                        <td class="align-middle"> {{$areasdata[0]["area"]["name"]}} </td>

                        {{-- 天気予報 --}}
                        @foreach ($weathers as $key => $weather)
                            <td>{{$weather}}</td>
                        @endforeach

                    </tr>
                </table>
            </p>
        </div>
    </main>
    <footer>

    </footer>
</body>
</html>
