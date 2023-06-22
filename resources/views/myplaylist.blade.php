<h1>myplaylist.blade.php</h1>
<div>
    <form action="" method="GET">
        <button type="button" name="add_list" value="add_list">プレイリスト作成</button>
    </form>
</div>
<?php

use SpotifyWebAPI\SpotifyWebAPI;
use SpotifyWebAPI\Session;

// Spotify APIクライアントの初期化
$session = new Session(
    'f172da853aeb4266863fb2661addbb76',
    'bcf72a943e1245828831cda721f77987'
);
$session->requestCredentialsToken();
$accessToken = $session->getAccessToken();

$api = new SpotifyWebAPI();
$api->setAccessToken($accessToken);

// 曲の検索
$query = 'artist:"' . 'SUPER BEAVER' . '"';
$results = $api->search($query, 'track');

// 検索結果から曲の情報を取得
$songs = $results->tracks->items;
?>

@foreach ($songs as $song)
    <?php
        $trackName = $song->name;
        $artistName = $song->artists[0]->name;
        $albumImage = $song->album->images[0]->url;
    ?>

    <div>
        <p>{{ $trackName }}</p>
        <p>{{ $artistName }}</p>
        <img src="{{ $albumImage }}" alt="Album Image">
    </div>
@endforeach
