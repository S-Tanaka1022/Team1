<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>初回現在地登録</title>
</head>
<body>
    <header>
        <h1>初回現在地登録</h1>
    </header>

    <main>
        都道府県選択
        <form action="new_area" method="POST">
            <select name="sel_region">
                @foreach($regions as $region)
                    <option value="{{$region -> region_code}}">{{$region -> region_name}}</option>
                @endforeach
            </select>
            <input type="submit" value="選択">
            @csrf
        </form>
    </main>
</body>
</html>

