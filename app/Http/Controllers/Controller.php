<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use SpotifyWebAPI\Session;
use Illuminate\Support\Str;
use SpotifyWebAPI\SpotifyWebAPI;
use App\Models\Region_name;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    public static function getAPI()
    {
        $session = new Session(
            'f172da853aeb4266863fb2661addbb76',
            'bcf72a943e1245828831cda721f77987'
        );
        $session->requestCredentialsToken();
        $accessToken = $session->getAccessToken();
        $api = new SpotifyWebAPI();
        $api->setAccessToken($accessToken);

        return $api;
    }

    public static function getMessage($data)
    {
        $fir_weathers = $data[0]["weathers"];
        if (Str::contains($fir_weathers[0], '雨')) {
            $message = "傘は持ちましたか？";
        } elseif (Str::contains($fir_weathers[0], '晴')) {
            $message = "お出かけ日和ですね！";
        } else {
            $message = "お疲れ様です！今日もかっこよく働きましょう！";
        }
        return $message;
    }

    public static function get_weather_forecast($data)
    {
        $fir_weathers = $data[0]["weathers"];
        $fir_area = $data[0]["area"];
        if (Str::contains($fir_weathers[0], '雨')) {
            $message = $fir_area . "は雨の予報が出ています";
        } elseif (Str::contains($fir_weathers[0], '晴')) {
            $message = $fir_area . "は晴れの予報が出ています";
        } else {
            $message = Auth::user()->name . "さん！お疲れ様です！";
        }
        return $message;
    }

    public static function get_weatherAPI($fav_regions)
    {
        $API_data = []; // Initialize as an empty array

        foreach ($fav_regions as $fav_region) {
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

            $API_data[] = [ // Append a new array to $API_data
                'id' => $id,
                'prefecture' => $prefecture,
                'area' => $area,
                'weathers' => $weathers,
                'region_code' => $region_code,
                'area_code' => $area_code,
            ];
        }
        return $API_data;
    }

    public static function areaReplace($table_data)
    {
        $area = $table_data["area"];
        $replace_area = array("地方" => "地域",);
        $area = str_replace(array_keys($replace_area), array_values($replace_area), $area);
        return $area;
    }

    public static function weatherToIcon($weathers)
    {
        if (isset($weathers)) {
            $weather = $weathers;
            $replacements = array(
                "雨" => "<br><img src = '" . asset('images/normal/rainny.png') . "' alt = '雨のイラスト' width = '50px'><br>",
                "晴れ" => "<br><img src = '" . asset('images/normal/sunny.png') . "' alt = '晴れのイラスト' width = '50px'><br>",
                "雷" => "<br><img src = '" . asset('images/normal/thunder.png') . "' alt = '雷のイラスト' width = '50px'>",
                "雪" => "<br><img src = '" . asset('images/normal/snow.png') . "' alt = '雪のイラスト' width = '50px'><br>",
                "くもり" => "<br><img src = '" . asset('images/normal/cloudy.png') . "' alt = 'くもりのイラスト' width = '50px'><br>",
                "　" => "",
                "所により" => "",
                "<br><br>" => "<br>",
                "<br>で<br>" => "",
            );
            $result = str_replace(array_keys($replacements), array_values($replacements), $weather);
            return $result;
        } else {
            return "情報取得中";
        }
    }

    public static function weatherTracks($fav_region, $api)
    {
        $region_code = $fav_region["region_code"];
        $area_code = $fav_region["area_code"];
        $url = "https://www.jma.go.jp/bosai/forecast/data/forecast/{$region_code}.json";
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        $areas_data = $data[0]["timeSeries"][0]["areas"];
        $weathers = $areas_data[$area_code]["weathers"];
        $search_word = preg_split('/\p{Zs}/u', $weathers[0], 2)[0];
        if ($search_word == "くもり") {
            $search_word = "曇";
        }
        $limit = 3;
        $options = [
            'limit' => $limit,
            'offset' => random_int(0, 100),
        ];
        $results = $api->search($search_word, 'track', $options);
        return $results;
    }

    public static function getAreaData($fav_region)
    {
        $region_code = $fav_region["region_code"];
        $area_code = $fav_region["area_code"];
        $region = Region_name::where('region_code', "$region_code")->get();
        $region_data = json_decode($region, true);

        $url = "https://www.jma.go.jp/bosai/forecast/data/forecast/{$region_code}.json";
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        $areas_data = ($data[0]["timeSeries"][0]["areas"]);
        return[$areas_data,$region_data,$area_code];
    }

    public static function replaceWord($areas)
    {
        $area = $areas['area']['name'];
        $replace_area = array(
            "地方" => "地域",
            );
        $area = str_replace(array_keys($replace_area), array_values($replace_area), $area);
        return $area;
    }
}
