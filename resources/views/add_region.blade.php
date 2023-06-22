<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>登録地追加（ログイン後）</title>
</head>
<body>
    <header>
        <h1>登録地追加（ログイン後）</h1>
    </header>

    <main>
        都道府県選択
        <form action="add_area" method="POST">
            <select name="sel_region">
                @foreach($regions as $region)
                    <option value="{{$region -> region_code}}">{{$region -> region_name}}</option>
                @endforeach
            </select>
            <input type="submit" value="選択">
            @csrf
        </form>
        <div>
            <h1>現在の登録地</h1>
            @php
            use App\Models\Region_name;
            foreach ($fav_regions as $fav_region){
                $region_code = $fav_region["region_code"];
                $region = Region_name::where('region_code', "$region_code")->get();
                $region_data = json_decode($region, true);

                foreach ($region_data as $data ){
                    echo "<p>".$data["region_name"]. "</p>";
                }

            }
            @endphp
        </div>
    </main>
</body>
</html>

