<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/posts', PostController::class);

Route::post('/comment/{post_id}', [CommentController::class, 'store'])->middleware(['auth'])->name('comment.store');

Route::post('/like/{post}', [LikeController::class, 'store'])->middleware(['auth'])->name('like.store');

Route::get('/posts/myindex', [LikeController::class, 'my_index'])->name('posts.myindex');

Route::delete('/posts/images/{id}', [PostController::class, 'deleteImage'])->middleware(['auth']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
