<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Region_name;
use SpotifyWebAPI\SpotifyWebAPI;
use SpotifyWebAPI\Session;

class UserController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id;
        $regions = Region_name::all();
        $fav_regions = Region::where('user_id', "$user_id")->get();
        if ($fav_regions->count() > 0) {
            $api = Controller::getAPI();
            return view('index', compact('regions', 'fav_regions', 'api'));
        } else {
            return redirect('/new_region');
        }
    }
}
