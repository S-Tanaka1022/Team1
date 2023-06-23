<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SpotifyWebAPI\SpotifyWebAPI;
use SpotifyWebAPI\Session;

class PlaylistController extends Controller
{
    public function index(Request $request){
        $auth_info = Auth::user()->id;
        $playlists = Playlist::where('user_id', $auth_info)->get();

        $session = new Session(
            'f172da853aeb4266863fb2661addbb76',
            'bcf72a943e1245828831cda721f77987'
        );
        $session->requestCredentialsToken();
        $accessToken = $session->getAccessToken();

        $api = new SpotifyWebAPI();
        $api->setAccessToken($accessToken);
        $trackId = $request->add_mylist;
        $track = $api->getTrack($trackId);

        return view('add_myplaylist', compact('playlists','track','trackId'));
    }

    public function add(Request $request)
    {
        /* バリデーション
        $request->validate([
            'image' => 'required|max:1024|mimes:jpg,jpeg,png,gif'
        ]);
        */

        /* Playlist オブジェクトを生成 */
        $add_playlist = new Playlist();

        $playlist_name = $request->playlist_name;
        $auth_info = Auth::user()->id;
        //dd($auth_info);

        if($playlist_name != null){//新規作成プレイリストの場合
            $add_playlist->user_id = $auth_info;
            $add_playlist->list_name = $playlist_name;

            /* データベースにレコードを追加する */
            $add_playlist->save();
        }else{//プレイリストを選択した場合
            $add_playlist = Playlist::find($request->list_id);
        }

        /* Song オブジェクトを生成 */
        $add_song = new Song();

        $add_song->song_detail_id = $request->trackId;

        $add_song->save();

        $add_playlist->songs()->attach($add_song->id);//中間テーブルにレコード追加

        print("<a href='everyone_playlist'>みんなプレイリストに戻る</a>");
    }

    public function myplaylist () {
        return view('myplaylist');
    }
}
