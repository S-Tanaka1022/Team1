<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        return view('everyone_playlist');
    }
}
