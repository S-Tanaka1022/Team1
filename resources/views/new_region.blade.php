<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>初回現在地登録</title>
</head>

<body>
    <header class="border-bottom border-1 border-secondary">
        <nav class="navbar navbar-light bg-light">
            <h1>初回現在地登録</h1>
                <p class="navbar-text mt-3">
                    {{ Auth::user() -> name }} さん ログイン中
                </p>
        </nav>
    </header>

    <main>
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

