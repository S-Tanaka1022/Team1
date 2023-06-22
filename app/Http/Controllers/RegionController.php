<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use App\Models\Region;
use App\Models\Region_name;

class RegionController extends Controller
{
    public function new()
    {
        $regions = Region_name::all();
        return view("new_region", compact('regions'));
    }

    public function new_area(Request $request)
    {
        // 地域コードが送られてくる
        $region_code = $request->sel_region;
        $url = "https://www.jma.go.jp/bosai/forecast/data/forecast/{$region_code}.json";
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        $areas_data = ($data[0]["timeSeries"][0]["areas"]);

        return view("new_area", compact('areas_data', 'region_code'));
    }

    public function update(Request $request)
    {
        $new_region = new Region();
        /* リクエストで渡された値を設定する */
        $new_region->user_id = auth()->user()->id;
        $new_region->region_code = $request->region_code;
        $new_region->area_code = $request->sel_area_code;

        /* データベースに保存 */
        $new_region->save();

        /* 完了画面を表示する */
        return redirect('/index');
    }

    public function add()
    {
        $user_id = auth()->user()->id;
        $regions = Region_name::all();
        $fav_regions = Region::where('user_id', "$user_id")->get();
        return view("add_region", compact('regions', 'fav_regions'));
    }

    public function add_area(Request $request)
    {
        // 地域コードが送られてくる
        $region_code = $request->sel_region;
        $url = "https://www.jma.go.jp/bosai/forecast/data/forecast/{$region_code}.json";
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        $areas_data = ($data[0]["timeSeries"][0]["areas"]);
        $user_id = auth()->user()->id;
        $regions = Region_name::all();
        $fav_regions = Region::where('user_id', "$user_id")->get();

        return view("add_area", compact('areas_data', 'region_code','fav_regions'));
    }
}
