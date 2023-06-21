<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/{id}', function ($id) {
    $url = "https://www.jma.go.jp/bosai/forecast/data/forecast/$id.json";

    $json = file_get_contents($url);
    $weatherdata = json_decode($json, true);

    $areasdata = ($weatherdata[0]["timeSeries"][0]["areas"]);

    foreach ($areasdata as $key => $data) {
        $area = $data["area"];
        $weatherCodes = $data["weatherCodes"];
        $weathers = $data["weathers"];
        $winds = $data["winds"];
        $waves = $data["waves"];

        echo $area["name"] . "の天気<hr>";

        foreach ($weatherCodes as $key => $weatherCode) {
            echo $key + 1 . "番目の天気コード：" . $weatherCode . "<br>";
        }
        echo "<hr>";

        foreach ($weathers as $key => $weather) {
            echo $key + 1 . "番目の天気：" . $weather . "<br>";
        }
        echo "<hr>";

        foreach ($winds as $key => $wind) {
            echo $key + 1 . "番目の風向き：" . $wind . "<br>";
        }
        echo "<hr>";

        foreach ($waves as $key => $wave) {
            echo $key + 1 . "番目の風速：" . $wave . "<br>";
        }
        echo "<hr>";
    }
});


// Route::get('/130000', function () {
//     $url = "https://www.jma.go.jp/bosai/forecast/data/forecast/130000.json";

//     $json = file_get_contents($url);
//     $weather = json_decode($json);

//     echo "<pre>";
//     var_dump($weather);
//     echo "</pre>";
// });


Route::get('login', [LoginController::class, 'login']);
