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
?>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<header>
    <nav class="navbar navbar-light bg-light">
        <h1>楽曲詳細</h1>
            <p class="navbar-text mt-3">
                {{ Auth::user() -> name }} さん ログイン中
            </p>
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <form action="index" method="get">
                    <button class="btn btn-primary" type="submit">ホーム</button>
                </form>
            </li>
            <li class="nav-item">
                <form action="myplaylists" method="get">
                    <button class="btn btn-primary" type="submit">マイプレイリスト</button>
                </form>
            </li>
            <li class="nav-item">
                <form action="everyone_playlist" method="get">
                    <button class="btn btn-primary" type="submit">みんなのプレイリスト</button>
                </form>
            </li>
            <li class="nav-item">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button class="btn btn-danger" type="submit">ログアウト</button>
                </form>
            </li>
        </ul>
    </nav>
</header>

<main>
    <div class="container m-10 p-10 rounded bg-dark text-white">
        <div class="text-center"><br>
            <img src={{$trackImage}} width=350><br>
            <span style="font-size: 40px;" class="fw-bold">{{$trackName}}</span>　　{{$minutes}}:{{$secondsFormat}}<br>
            <span style="font-size: 20px;" class="fw-bold">{{$albumName}}</span><br>
            <div class="container-fluid">
                <div class="row justify-content-center align-items-center">
                    <div class="col-md-auto text-center">
                       <img src={{$artistImage}} width=100 class="rounded-circle">
                    </div>
                    <div class="fs-1 text-left align-middle">{{$artistName}}<br>
                        @foreach($artist->genres as $genre)
                            {{$genre}}　
                        @endforeach<br>
                        {{$dateFormat}}
                    </div>
                </div>
            </div><br>
            @if ($trackPreview)
                <audio controls class="w-400">
                    <source src="{{$trackPreview}}" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio><br>
            @else
                Preview not available.<br>
            @endif
        </div><br>
        <div class="container m-10">
            <div class="row">
                <div class="col">
                    <form action="add_myplaylist" method="get" enctype="multipart/form-data">
                        <div class="d-flex justify-content-center align-items-center">
                            <button class="btn btn-light btn-block" type="submit" name="add_mylist" value="{{$track->id}}">
                                リストへ追加
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col">
                    <div class="d-flex justify-content-center align-items-center">
                        <button class="btn btn-light btn-block" name="back" onclick="location.href='/everyone_playlist'">
                            楽曲一覧に戻る
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
