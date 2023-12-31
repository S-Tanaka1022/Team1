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
    <title>初回現在地登録</title>
</head>

<body>
    <header class="border-bottom border-1 border-secondary">
        <nav class="navbar navbar-light bg-light">
            <h2 class="Lobster">Temporature</h2>
            <h4>初回現在地登録</h4>
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
            都道府県選択
            <form action="new_area" method="POST">
                <select name="sel_region" class="form-select form-select-lg text-center w-25">
                    @foreach($regions as $region)
                        <option value="{{$region -> region_code}}">{{$region -> region_name}}</option>
                    @endforeach
                </select>
                <input class="btn btn-info mb-2" type="submit" value="選択">
                @csrf
            </form>
        </div>
    </main>
</body>
</html>

