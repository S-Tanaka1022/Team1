<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Region_name;

class RegionController extends Controller
{
    public function new(){
        $regions = Region_name::all();
        return view("new_region",compact('regions'));
    }

    public function new_area(Request $request){
        // 地域コードが送られてくる
        $seled_region_code = $request["sel_region"];
        $url2 = "https://www.jma.go.jp/bosai/forecast/data/forecast/{$seled_region_code}.json";
        $response2 = file_get_contents($url2);
        $data2 = json_decode($response2, true);
        $areas_data = ($data2[0]["timeSeries"][0]["areas"]);

        return view("new_area", compact('areas_data','seled_region_code'));
    }
}
