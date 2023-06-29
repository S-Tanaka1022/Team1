{{-- 楽曲一覧とみんなのプレイリストの一覧画面 --}}
{{-- 楽曲を一覧として表示する画面がページ1（詳細画面、追加画面に遷移できる） --}}
{{-- みんなのプレイリストの一覧を表示する画面がページ2 (詳細画面に遷移できる） --}}

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <title>みんなのプレイリスト</title>

    @vite(['resources/css/testcss.css'])
</head>

<body>

    <section class="someTabs" data-tabs="">
        <nav class="tabs__nav">
          <a href="#" class="tabs__item active" data-tab="">楽曲一覧</a>
          <a href="#" class="tabs__item" data-tab="">プレイリスト一覧</a>
          <a class="Tabs__presentation-slider" role="presentation"></a>
        </nav>
        <div class="tabs__body">
          <div class="tabs__content active" data-tab-content="">
                <div class="container align-middle text-center">
                    <div class="row align-items-center text-center">
                        <div class="col-2">
                            <button class="btn btn-primary btn-block" name="back" onclick="location.href=''">
                                楽曲更新
                            </button>
                        </div>
                        <div class="col-8">
                            <form action="" method="GET">
                                <label>
                                    検索キーワード
                                    <input type="text" name="keyword" placeholder="検索">
                                </label>
                                <input type="submit" class="btn btn-primary" value="検索">
                            </form>
                        </div>
                    </div>
                </div>

                <table class="table text-center align-middle mt-4">
                    <tr class="bg-dark text-white">
                        <th>ジャケット写真</th>
                        <th>曲名</th>
                        <th>アーティスト名</th>
                        <th class="text-right">プレリストに追加</th>
                        <th>詳細を表示</th>
                    </tr>
                </table>
          </div>

            <div class="tabs__content" data-tab-content="">
                <form action="" method="GET">
                    <label>
                        <input class="col-12" type="text" name="keyword2" placeholder="検索"  onclick="showTab('tabpage2'); return false;">
                    </label>
                    <input type="submit" value="検索" class="btn btn-primary">
                </form>
                <table class="table text-center align-middle mt-4">
                    <tr class="bg-dark text-white">
                        <th>ユーザ名</th>
                        <th>プレイリスト名</th>
                        <th>詳細</th>
                    </tr>
                </table>
            </div>
          </div>
    </section>
    <script src="{{ asset('/js/testcss.js') }}"></script>
</body>
</html>
