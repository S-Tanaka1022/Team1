<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>エリア選択画面</title>
</head>
<body>
    <header>
        <h1>エリア選択画面</h1>
    </header>

    <main>
        エリア選択
        <form action="" method="POST">
            <select name="sel_area">
                @foreach($areas_data as $areas)
                    <option value="{{$areas['area']['code']}}">{{$areas['area']['name']}}</option>
                @endforeach
            </select>
        <input type="submit" value="選択">
        @csrf
        </form>
    </main>
</body>
</html>
