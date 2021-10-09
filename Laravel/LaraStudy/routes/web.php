<?php

use App\Http\Controllers\LikesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// resource는 네임이 지정되어 있기 때문에 name을 지정해주면 안된다.
Route::resource('/posts', PostsController::class)->middleware(['auth']);

Route::delete('/posts/images/{id}', [PostsController::class, "deleteImage"])->middleware(['auth']);

Route::post('/like/{post}', [LikesController::class, 'store'])->middleware(['auth'])->name('like.store');



Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// auth.php에 가면 로그인에 대한 라우터가 정의되어 있다.
require __DIR__ . '/auth.php';
