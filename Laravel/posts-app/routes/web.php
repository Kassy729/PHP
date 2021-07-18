<?php

use App\Http\Controllers\ChartController;
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



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/', [PostController::class, 'home']);

Route::get('posts/create', [PostController::class, 'create']);/*->middleware(['auth']); */ 
//auth 미들웨어를 거쳐서 posts/create 가 실행되게 함
Route::post('posts/store', [PostController::class, 'store'])->name('posts.store'); 
/*->middleware(['auth']);*/


Route::get('/posts/index', [PostController::class, 'index'])->name('posts.index');

Route::get('/posts/my_index', [PostController::class, 'my_index'])->name('posts.my_index');

Route::get('/posts/show/{id}', [PostController::class, 'show'])->name('post.show');  //url에 포함된 id를 {id}로 받겠다?????? {id}의 의미??


Route::get('/posts/{post}', [PostController::class, 'edit'])->name('post.edit');
Route::put('/posts/{id}', [PostController::class, 'update'])->name('post.update');

Route::delete('posts/{id}', [PostController::class, 'destroy'])->name('post.delete');

Route::get('/chart/index', [ChartController::class, 'index']);

Route::post('/posts/search', [PostController::class, 'search'])->name('posts.search');