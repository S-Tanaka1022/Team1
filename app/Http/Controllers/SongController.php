<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SpotifyWebAPI\SpotifyWebAPI;
use SpotifyWebAPI\Session;

class SongController extends Controller
{
    public function index(Request $request)
    {
        /* Requestに送信された検索キーワードを変数に保持 */
        $keyword = $request->input('keyword');
        //if (Str::length($keyword) > 0) { // Str::length(<文字列>) で、文字列の長さを取得できる
        //    $upload_images = UploadImage::where('filename', 'LIKE', "%$keyword%") // ファイル名にkeyword を含むものを絞り込み
        //        ->orWhere('memo', 'LIKE', "%$keyword%") // 備考にkeyword を含むものを絞り込み
        //        ->get();
        //} else {
        //    /* 検索キーワードが入力されていない場合は、全件取得する */
        //    $upload_images = UploadImage::all();
        //}

        $session = new Session(
            'f172da853aeb4266863fb2661addbb76',
            'bcf72a943e1245828831cda721f77987'
        );
        $session->requestCredentialsToken();
        $accessToken = $session->getAccessToken();

        $api = new SpotifyWebAPI();
        $api->setAccessToken($accessToken);

        $limit = 30;
        $query = 'genre:"japanese"';
        $options = [
            'limit' => $limit,
            'offset' => random_int(0,1000),
        ];

        $results = $api->search($query,'track',$options);
        return view('everyone_playlist', compact('results'));
    }

    public function information(){
        return view('/song_information');
    }
}
