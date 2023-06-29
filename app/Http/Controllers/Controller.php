<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use SpotifyWebAPI\Session;
use SpotifyWebAPI\SpotifyWebAPI;
use App\Models\Region_name;
use App\Http\Controllers\RegionNameController;

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

    public static function weatherToIcon($weathers)
    {
        if (isset($weathers)) {
            $weather = $weathers;
            $replacements = array(
                "雨" => "<br><img src = '".asset('images/normal/rainny.png')."' alt = '雨のイラスト' width = '50px'><br>",
                "晴れ" => "<br><img src = '".asset('images/normal/sunny.png')."' alt = '晴れのイラスト' width = '50px'><br>",
                "雷" => "<br><img src = '".asset('images/normal/thunder.png')."' alt = '雷のイラスト' width = '50px'>",
                "雪" => "<br><img src = '".asset('images/normal/snow.png')."' alt = '雪のイラスト' width = '50px'><br>",
                "くもり" => "<br><img src = '".asset('images/normal/cloudy.png')."' alt = 'くもりのイラスト' width = '50px'><br>",
                "　" => "",
                "所により" => "",
                "<br><br>" => "<br>",
                "<br>で<br>" => "",
                );
            $result = str_replace(array_keys($replacements), array_values($replacements), $weather);
            return $result;
        }else{
            return "情報取得中";
        }
    }

    public static function weatherTracks($fav_region,$api)
    {
        $region_code = $fav_region["region_code"];
        $area_code = $fav_region["area_code"];
        $url = "https://www.jma.go.jp/bosai/forecast/data/forecast/{$region_code}.json";
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        $areas_data = $data[0]["timeSeries"][0]["areas"];
        $weathers = $areas_data[$area_code]["weathers"];
        $search_word= preg_split('/\p{Zs}/u', $weathers[0], 2)[0];
        if($search_word=="くもり")
        {
            $search_word="曇";
        }
        $limit = 3;
        $options = [
            'limit' => $limit,
            'offset' => random_int(0,100),
        ];
        $results = $api->search($search_word, 'track', $options);
        return $results;
    }
}
