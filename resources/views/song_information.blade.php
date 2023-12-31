{{-- 楽曲詳細画面 --}}
{{-- リストへ追加ボタンと楽曲一覧に戻るボタンが設置されてる --}}

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

    use App\Http\Controllers\Controller;
    $message=Controller::get_weather_forecast($data);
?>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
{{-- フォント Link --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lobster+Two&display=swap" rel="stylesheet">
{{-- 自作CSSファイル --}}
@vite(['resources/css/index_css.css'])

<header class="border-bottom border-1 border-secondary">
    <nav class="navbar navbar-light bg-light">
        <h2 class="Lobster">Temporature</h2>
        <h4>楽曲詳細</h4>
            <p class="navbar-text mt-3">
                    {{$message}}
            </p>
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <form action="index" method="get">
                    <button class="btn btn-primary mr-3" type="submit">ホーム</button>
                </form>
            </li>
            <li class="nav-item">
                <form action="myplaylist" method="get">
                    <button class="btn btn-primary mr-3" type="submit">マイプレイリスト</button>
                </form>
            </li>
            <li class="nav-item">
                <form action="everyone_playlist" method="get">
                    <button class="btn btn-primary mr-3" type="submit">楽曲一覧</button>
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
    <br><br><div class="container m-10 p-10 rounded bg-dark text-white">
        <div class="text-center"><br><br>
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
                    <div class="d-flex justify-content-center align-items-center">

                        <button class="btn btn-info btn-block btn-lg" onclick="goBack()">
                            <b>戻る</b>
                        </button>

                        <script>
                        function goBack() {
                        window.history.back();
                        }
                        </script>
                    </div>
                </div>
                <div class="col">
                    <form action="add_myplaylist" method="get" enctype="multipart/form-data">
                        <div class="d-flex justify-content-center align-items-center">
                            <button class="btn btn-success btn-block btn-lg" type="submit" name="add_mylist" value="{{$track->id}}">
                                <b>リストへ追加</b>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div><br>
    </div><br><br>
</main>
