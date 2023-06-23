<?php
// dump($track);
$trackName = $track->name;
$artistName = $track->artists[0]->name; // 一番最初のアーティスト名を使用する例

echo "Track Name: $trackName" . PHP_EOL;
echo "Artist Name: $artistName" . PHP_EOL;
?>
