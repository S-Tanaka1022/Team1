<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use SpotifyWebAPI\Session;
use SpotifyWebAPI\SpotifyWebAPI;

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
}
