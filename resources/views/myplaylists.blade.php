<h1>自分のプレイリスト一覧画面</h1>
<table border='1'>
    <tr>
        <th>プレイリスト名</th>
        <th>詳細</th>
    </tr>

    @foreach ($playlists as $playlist)
        <tr>
            <td>{{$playlist->list_name}}</td>
            <td><a href="/my_playlist">詳細</a></td>
        </tr>
    @endforeach
</table>
