<?php
//曲の詳細情報
$trackImage = $track->album->images[0]->url; //アルバム画像
$releaseDate = $track->album->release_date; //リリース日
    $dateFormat = date("Y年m月d日", strtotime($releaseDate));
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
$artistImage = $artist->images[0]->url; //アーティストの宣材写真

echo "Song Detail<br>";
echo "<img src='$trackImage' width=80><br>";
echo "Track Name: $trackName<br>" . PHP_EOL;
echo "Album Name: $albumName<br>" . PHP_EOL;
echo "Release Date: $dateFormat<br>";
echo "<img src='$artistImage' width=80><br>";
echo "Artist Name: $artistName<br>" . PHP_EOL;
echo "Genres: ";
foreach($artist->genres as $genre){
   print($genre . " ");
}
echo "<br>";
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
?>
