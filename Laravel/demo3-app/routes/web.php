<?php

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
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::get('posts/create', [PostController::class, 'create'])->name('posts/create');

Route::post('posts/store', [PostController::class, 'store'])->name('posts.store');

Route::get('posts/index', [PostController::class, 'index'])->name('posts.index');

Route::get('posts/my_post', [PostController::class, 'my_post'])->name('posts.my_post');

Route::get('posts/show/{id}', [PostController::class, 'show'])->name('posts.show');

Route::get('posts/{post}', [PostController::class, 'edit'])->name('posts.edit');

Route::put('posts/{id}', [PostController::class, 'update'])->name('posts.update');

Route::delete('post/{id}', [PostController::class, 'destroy'])->name('posts.delete');