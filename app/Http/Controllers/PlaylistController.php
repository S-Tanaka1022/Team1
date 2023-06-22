<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlaylistController extends Controller
{
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
        }

        /* Song オブジェクトを生成 */
        $add_song = new Song();

        $add_song->title = $request->title;
        $add_song->artist = $request->artist;

        $add_song->save();

        $add_playlist->songs()->attach($add_song->id);

        print("<a href='everyone_playlist'>みんなプレイリストに戻る</a>");
    }
    public function index(Request $request){
        return view('add_myplaylist',['title' => $request->trackName , 'artist' => $request->artistName]);
    }
}
