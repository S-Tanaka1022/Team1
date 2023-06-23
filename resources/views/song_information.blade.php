<?php
dump($track);
//曲の詳細情報
$trackName = $track->name; //曲名
$artistName = $track->artists[0]->name; //アーティスト名
$trackTime = $track->duration_ms; //曲の再生時間
    $seconds = floor($trackTime/1000);
    $minutes = floor($seconds/60);
    $seconds = $seconds%60;
    $secondsFormat = sprintf('%02d', $seconds);
$albumName = $track->album->name; //アルバム名
$trackPreview = $track->preview_url; //プレビューのURL(日本の曲は対応してないことが多い)

//アーティスト情報
$artists = $track->artists;
// $artistImage = $artists->images[0]->url;
// $genres = [];
// foreach($artists as $artist){
//     $genres = array_merge($genres, $artist->genres);
// }
// $genres = array_unique($genres);

echo "Song Detail<br>";
echo "Track Name: $trackName<br>" . PHP_EOL;
echo "Album Name: $albumName<br>" . PHP_EOL;
echo "Artist Name: $artistName<br>" . PHP_EOL;
echo "Duration Time: $minutes:$secondsFormat<br>" . PHP_EOL;
if ($trackPreview) {
    echo '<audio controls>';
    echo "<source src=\"$trackPreview\" type=\"audio/mpeg\">";
    echo 'Your browser does not support the audio element.';
    echo '</audio>';
    echo "<br>";
} else {
    echo 'Preview not available.<br>';
}

echo "Artist Information<br>";

?>
