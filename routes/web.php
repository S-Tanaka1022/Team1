<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\RegionNameController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\UserController;

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


#ホーム画面
Route::get('/index', [UserController::class, 'index'])->middleware('auth');

#最初の現在地登録画面
Route::get('/new_region', [RegionController::class, 'new']);

#現在地追加画面
Route::get('/add_region', [RegionController::class, 'add']);

#自分のプレイリスト一覧画面
//Route::get('/myplaylists', [PlaylistController::class, 'index']);
Route::get('/myplaylist', function(){
    return view('myplaylist');
});

#プレイリスト確認画面
// Route::get('/myplaylist', [PlaylistController::class, 'detail']);

#プレイリスト追加画面
Route::get('/add_myplaylist', [PlaylistController::class, 'add']);


#全員のプレイリスト一覧画面と楽曲一覧画面
Route::get('/everyone_playlist', [SongController::class, 'index']);

#それぞれのプレイリスト確認画面
Route::get('/other_playlist', [SongController::class, 'detail']);

require __DIR__ . '/auth.php';
