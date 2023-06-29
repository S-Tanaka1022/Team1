<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use SpotifyWebAPI\SpotifyWebAPI;
use SpotifyWebAPI\Session;

class UserController extends Controller
{
    public $weathers;

    public function index()
    {

        $user_id = auth()->user()->id;
        $fav_regions = Region::where('user_id', "$user_id")->get();
        $data = $this->get_weatherAPI($fav_regions);
        // echo "<pre>";
        // var_dump($data);
        // echo "</pre>";
        if ($data !== null) {
            $api = Controller::getAPI();
            return view('index', compact('data', 'api'));
        } else {
            return redirect('/new_region');
        }
    }
}
