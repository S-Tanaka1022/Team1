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
        $playlists = Playlist::getUserPlaylists($auth_info);
        $api = Controller::getAPI();
        $trackId = $request->add_mylist;
        $track = $api->getTrack($trackId);
        $artistId = $track->artists[0]->id;
        $artist = $api->getArtist($artistId);

        return view('add_myplaylist', compact('playlists','track','trackId','artist'));
    }

    public function add(Request $request)
    {
        $add_playlist = new Playlist();
        $playlist_name = $request->playlist_name;
        $auth_info = Auth::user()->id;

        if($playlist_name != null){//新規作成プレイリストの場合
            $add_playlist->user_id = $auth_info;
            $add_playlist->list_name = $playlist_name;
            $add_playlist->save(); /* データベースにレコードを追加する */
        }else{//プレイリストを選択した場合
            $add_playlist = Playlist::find($request->list_id);
        }
        /* Song オブジェクトを生成 */
        $add_song = new Song();
        $add_song->song_detail_id = $request->trackId;
        $add_song->title = $request->title;
        $add_song->artist = $request->artist;
        $add_song->save();
        $add_playlist->songs()->attach($add_song->id);//中間テーブルにレコード追加

        return redirect("everyone_playlist");
    }

    public function myplaylist () {
        $auth_info = Auth::user()->id;
        $playlists = Playlist::getUserPlaylists($auth_info);
        return view('/myplaylists', compact('playlists'));
    }
}
