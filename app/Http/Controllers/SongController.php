<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SpotifyWebAPI\SpotifyWebAPI;
use SpotifyWebAPI\Session;
use Illuminate\Support\Str;

class SongController extends Controller
{
    public function index(Request $request)
    {
        $api = Controller::getAPI();
        $keyword = $request->keyword; /* Requestに送信された検索キーワードを変数に保持 */
        if (Str::length($keyword) > 0) { // Str::length(<文字列>) で、文字列の長さを取得できる
            $query = $keyword;
            $offset = 10;
        } else { /* 検索キーワードが入力されていない場合は、全件取得する */
            $query = 'genre:"japanese"';
            $offset = 1000;
        }
        $options = [
            'limit' => 30,
            'offset' => random_int(0, $offset),
        ];
        $results = $api->search($query, 'track', $options);

        //プレイリスト一覧表示のためのデータベース読み込み
        $auth_info = Auth::user()->id;
        $keyword2 = $request->input('keyword2');
        if (Str::length($keyword2) > 0) { // キーワードが入っている場合
            $playlists = Playlist::where('list_name', 'LIKE', "%$keyword2%") // プレイリスト名にkeyword2 を含むものを絞り込み
                ->where('user_id', '!=', $auth_info) //ログイン中のユーザー以外のプレイリスト
                ->get();
        } else {
            /* 検索キーワードが入力されていない場合は、全件取得する */
            //$playlists = Playlist::getUserPlaylists($auth_info); //ログイン中のユーザー以外のプレイリストを表示
            $playlists = Playlist::where('user_id', '!=', $auth_info)->get(); //ログイン中のユーザー以外のプレイリストを表示
        }

        return view('everyone_playlist', compact('results', 'playlists'));
    }

    public function information(Request $request)
    {
        $api = Controller::getAPI();
        $trackId = $request->information;
        $track = $api->getTrack($trackId);
        $artistId = $track->artists[0]->id;
        $artist = $api->getArtist($artistId);

        return view('/song_information', compact('track', 'artist'));
    }

    public function detail(Request $request)
    {
        $api = Controller::getAPI();
        $auth_info = Auth::user()->id;
        $keyword3 = $request->keyword3;//キーワード
        if (Str::length($keyword3) > 0){//検索している場合
            $song_id = Song::where('title', 'LIKE', "%$keyword3%") // プレイリスト名にkeyword2 を含むものを絞り込み
            ->orwhere('artist', 'LIKE', "%$keyword3%")
            ->get();
            $select_id = [];//検索結果を配列に入れる
            for($i=0;$i<count($song_id);$i++){
                $select_id[] = $song_id[$i]->id;
            }
            $playlistId = $request->playlist_id;
            $playlist = Playlist::findOrFail($playlistId);
            $songs = $playlist->songs;
            $tracks = [];
            foreach ($songs as $song) {
                for($i=0;$i<count($select_id);$i++){
                    if($select_id[$i] == $song->id){//検索と一致
                        $trackId = $song->song_detail_id;
                        $tracks[] = $api->getTrack($trackId);
                    }
                }
            }
        }else{//検索していない
            $playlistId = $request->playlist_id;

            $playlist = Playlist::findOrFail($playlistId);
            $songs = $playlist->songs;
            $tracks = [];

            foreach ($songs as $song) {
                $trackId = $song->song_detail_id;
                $tracks[] = $api->getTrack($trackId);
            }
        }
        return view('other_playlist',compact('playlist','tracks','playlistId'));
    }
}
