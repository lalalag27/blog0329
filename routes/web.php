<?php

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/FeNewsIndex', App\Livewire\Frontend\News\FeNewsIndex::class)->name('fe.news.index');
Route::get('/FeNewsShow', App\Livewire\Frontend\News\FeNewsShow::class)->name('fe.news.show');


// 如果客戶沒有做會員註冊，就直接轉址到登入頁面
Route::get('/register', function () {
    return redirect()->route('login');
});

// 前臺會員登入
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('admin.dashboard');
    })->name('dashboard');
});

// 後臺
Route::prefix('admin')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // 轉址到login
    Route::get('/', function () {
        return redirect()->route('login');
    })->name('admin');

    // 後台首頁
    Route::get('/dashboard', App\Livewire\Backend\Dashboard\DashboardShow::class)->name('admin.dashboard');
});


// 這裡是tinymce的圖片上傳路徑
Route::post('/tinymec-upload', function (Request $request) {
    $request->validate([
        'file' => ['image', 'max:5120', 'required']
    ]);

    if ($request->file('file')) {
        // 建立時間(檔案路徑用)
        $date = date("Ymd");
        $nowTime = date("his");
        // 設定檔案名稱
        $imageName = $nowTime . '-' . Str::random(10) . '.' . $request->file('file')->extension();
        // 獲取圖片後另存路徑
        $path = $request->file('file')->storeAs('tinyMceFiles/' . $date, $imageName, 'public');

        // 到時候可以直接獲取sql上的路徑
        $response = [
            'image' => asset('storage/' . $path),
        ];
        // 響應結果
        return response($response);
    }
})->name('admin.tinymce.upload');