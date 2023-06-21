<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>index</title>
</head>

<body>
    <header>
        <h1>index.blade.php</h1>
        <p>
            {{ Auth::user() -> name }} さんログイン中
        </p>
    </header>

    <main>
        <form action="{{ route('logout') }}" method="post" class="max-w-md mx-auto px-4 py-6 bg-white rounded-md shadow-md">
            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 cursor-pointer">ログアウト</button>
            @csrf
        </form>
    </main>

    <footer>

    </footer>
</body>
</html>
