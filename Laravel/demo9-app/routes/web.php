<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\PostController;
use App\Models\Comment;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::resource('/post', PostController::class);

Route::post('/like/{post_id}', [LikesController::class, 'store'])->middleware(['auth']);

Route::post('/commentStore/{id}', [CommentController::class, "store"])->middleware(['auth']);

Route::get('comments/{post_id}', [CommentController::class, "index"])->middleware(['auth'])->name('comment.index');
