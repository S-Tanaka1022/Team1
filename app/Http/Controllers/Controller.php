<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use SpotifyWebAPI\Session;
use SpotifyWebAPI\SpotifyWebAPI;
use App\Models\Region_name;

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
            ];
        }
        return $API_data;
    }
}
