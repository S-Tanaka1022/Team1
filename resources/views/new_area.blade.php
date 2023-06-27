@php
    $i=0;
@endphp

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- 自作CSSファイル -->
    @vite(['resources/css/region_area.css'])
    <title>エリア選択画面</title>
</head>

<body>
    <header class="border-bottom border-1 border-secondary">
        <nav class="navbar navbar-light bg-light">
            <h1>エリア選択画面</h1>
                <p class="navbar-text mt-3">
                    {{ Auth::user() -> name }} さん ログイン中
                </p>
        </nav>
    </header>

    <main>
        <div class="select_new">
        エリア選択
            <form action="code_save" method="POST">
                <input type="hidden" name="region_code" value="{{$region_code}}">
                <select name="sel_area_code">
                    @foreach($areas_data as $areas)
                        <option value="{{$i}}">{{$areas['area']['name']}}</option>
                        {{-- エリアコードをエリアごとに変化させ、送信 --}}
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
