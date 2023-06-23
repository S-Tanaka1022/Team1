<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;

    public function songs()
    {
        /* 中間テーブル(player_position テーブル)が持っているレコード で関連付けする
         * $this->belongsTo(<連携先クラス名>::class)
         */
        return $this->belongsToMany(Song::class);
    }

    public function user()
    {

        return $this->belongsTo(User::class);
    }
}
