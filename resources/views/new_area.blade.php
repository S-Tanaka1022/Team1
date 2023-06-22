@php
    $i=0;
@endphp

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
        <form action="" method="GET">
            <select name="sel_area">
                @foreach($areas_data as $areas)
                    <option value="{{$i}}">{{$areas['area']['name']}}</option>
                    {{-- エリアコードをエリアごとに変化させ、送信 --}}
                    {{$i+=1}}
                @endforeach
            </select>
        <input type="submit" value="選択">
        @csrf
        </form>
    </main>
</body>
</html>
