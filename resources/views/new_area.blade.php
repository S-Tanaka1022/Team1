@php
    $i=0;
    use App\Http\Controllers\Controller;
@endphp

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    {{-- フォント Link --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster+Two&display=swap" rel="stylesheet">
    {{-- 自作CSSファイル --}}
    @vite(['resources/css/index_css.css'])
    <title>エリア選択画面</title>
</head>

<body>
    <header class="border-bottom border-1 border-secondary">
        <nav class="navbar navbar-light bg-light">
            <h2 class="Lobster">Temporature</h2>
            <h4>エリア選択画面</h4>
                <p class="navbar-text mt-3">
                    {{ Auth::user() -> name }} さん ようこそ！
                </p>
        </nav>
    </header>

    <main>
        <div class="explaination ml-3 mt-3" style="font-size: 22px;">
            ご利用いただきありがとうございます！<br>
            天気予報を取得するため、観測地を登録してください！
        </div>
        <div class="select_new mt-3 mb-0 mx-3" style="font-size: 22px;">
        エリア選択
            <form action="code_save" method="POST">
                <input type="hidden" name="region_code" value="{{$region_code}}">
                <select name="sel_area_code" class="form-select form-select-lg text-center w-25">
                    @foreach($areas_data as $areas)
                        <?php $area = Controller::replaceWord($areas); ?>
                        <option value="{{$i}}">{{$area}}</option>
                        {{$i+=1}}
                    @endforeach
                </select>
                <input class="btn btn-info mb-2" type="submit" value="追加">
                    <button type="button" onclick="history.back()" class="btn btn-secondary mb-2">戻る</button>
            @csrf
            </form>
        </div>
    </main>
</body>
</html>
