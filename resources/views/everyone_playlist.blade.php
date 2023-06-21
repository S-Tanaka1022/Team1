みんなのプレイリスト画面
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>みんなのプレイリスト</title>
</head>
<body>
    <h1>みんなのプレイリスト</h1>

    <div>
        <form action="" method="GET">
            <label>
                検索キーワード
                <input type="text" name="keyword" value="{{ $keyword }}">
            </label>
            <input type="submit" value="検索">
        </form>
    </div>

    <table border='1'>
        <tr>
            <th>ファイル名</th>
            <th>画像</th>
            <th>URL</th>
            <th>備考</th>
        </tr>
        @foreach ($upload_images as $upload_image)
            <tr>
                <td>{{$upload_image->filename}}</td>
                <td><img src='{{$upload_image->filepath}}' width='200'></td>
                <td>http://localhost/{{$upload_image->filepath}}</td>
                <td>{{$upload_image->memo}}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>
