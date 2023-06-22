<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PlaylistController extends Controller
{
    public function index(Request $request){
        //var_dump($_GET);
        //var_dump($request);
        $playlists = Playlist::all();
        $title = $request->song_name;
        $artist = $request->artist_name;
        return view('add_myplaylist',compact('playlists','title','artist'));
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
            //print('test');
            //dd($request->input());
            //dd($request->list_id);
            //$add_playlist = Playlist::where('list_name', $request->list_name)->get();

            //var_dump($add_playlist);
            $add_playlist = Playlist::find($request->list_id);
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
