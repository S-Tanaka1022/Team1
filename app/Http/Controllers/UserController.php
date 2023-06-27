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
            $session = new Session(
                'f172da853aeb4266863fb2661addbb76',
                'bcf72a943e1245828831cda721f77987'
            );
            $session->requestCredentialsToken();
            $accessToken = $session->getAccessToken();

            $api = new SpotifyWebAPI();
            $api->setAccessToken($accessToken);
            return view('index', compact('regions', 'fav_regions', 'api'));
        } else {
            return redirect('/new_region');
        }
    }
}
