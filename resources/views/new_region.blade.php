{{-- @php
foreach ($regions as $key => $region) {
    $region_code = $region["region_code"];
    $region_name = $region["region_name"];

}
@endphp --}}

<!DOCTYPE html>
<html lang="en">
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
        現在地選択
        @dump($regions)
        <select name="position">
            {{-- @foreach ($regions as $key => $region)
                {{$region_code}} = {{$region -> region_code}}
                {{$region_name}} = {{$region -> region_name}}
                <option value="{{ $region_code }}">{{ $region_name }}</option>
            @endforeach --}}
        </select>
    </main>
</body>
</html>

