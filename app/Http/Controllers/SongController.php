<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SpotifyWebAPI\SpotifyWebAPI;
use SpotifyWebAPI\Session;
use Illuminate\Support\Str;

class SongController extends Controller
{
    public function index(Request $request)
    {
        $session = new Session(
            'f172da853aeb4266863fb2661addbb76',
            'bcf72a943e1245828831cda721f77987'
        );
        $session->requestCredentialsToken();
        $accessToken = $session->getAccessToken();

        $api = new SpotifyWebAPI();
        $api->setAccessToken($accessToken);
        /* Requestに送信された検索キーワードを変数に保持 */
        $keyword = $request->keyword;
        if (Str::length($keyword) > 0) { // Str::length(<文字列>) で、文字列の長さを取得できる
            $limit = 30;
            $options = [
                'limit' => $limit,
                'offset' => random_int(0,10),
            ];

            $results = $api->search($keyword,'track',$options);
        } else {
           /* 検索キーワードが入力されていない場合は、全件取得する */
           $limit = 30;
           $query = 'genre:"japanese"';
           $options = [
               'limit' => $limit,
               'offset' => random_int(0,1000),
           ];

           $results = $api->search($query,'track',$options);
        }
        // /* Requestに送信された検索キーワードを変数に保持 */
        // $keyword = $request->keyword;
        // if (Str::length($keyword) > 0) { // Str::length(<文字列>) で、文字列の長さを取得できる
        //    $upload_images = UploadImage::where('filename', 'LIKE', "%$keyword%") // ファイル名にkeyword を含むものを絞り込み
        //        ->orWhere('memo', 'LIKE', "%$keyword%") // 備考にkeyword を含むものを絞り込み
        //        ->get();
        // } else {
        //    /* 検索キーワードが入力されていない場合は、全件取得する */
        //    $upload_images = UploadImage::all();
        // }
        //$results = $api->search($query,'track',$options);


        //プレイリスト一覧表示のためのデータベース読み込み
        $auth_info = Auth::user()->id;
        $keyword2 = $request->input('keyword2');
        if (Str::length($keyword2) > 0) { // キーワードが入っている場合
            $playlists = Playlist::where('list_name', 'LIKE', "%$keyword2%") // プレイリスト名にkeyword2 を含むものを絞り込み
                ->where('user_id','!=', $auth_info) //ログイン中のユーザー以外のプレイリスト
                ->get();
        } else {
            /* 検索キーワードが入力されていない場合は、全件取得する */
            $playlists = Playlist::where('user_id','!=', $auth_info)->get();//ログイン中のユーザー以外のプレイリストを表示
        }

        return view('everyone_playlist', compact('results','playlists'));
    }

    public function information(Request $request){
        $session = new Session(
            'f172da853aeb4266863fb2661addbb76',
            'bcf72a943e1245828831cda721f77987'
        );
        $session->requestCredentialsToken();
        $accessToken = $session->getAccessToken();

        $api = new SpotifyWebAPI();
        $api->setAccessToken($accessToken);
        $trackId = $request->information;
        $track = $api->getTrack($trackId);
        $artistId = $track->artists[0]->id;
        $artist = $api->getArtist($artistId);

        return view('/song_information', compact('track','artist'));
    }
}
