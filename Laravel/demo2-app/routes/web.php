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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::get('/posts/create', [PostController::class, 'create'])->name('create');

Route::post('/posts/store', [PostController::class, 'store'])->name('store');

Route::get('/posts/index', [PostController::class, 'index'])->name('index');

Route::get('/posts/myindex', [PostController::class, 'myindex'])->name('myindex');

Route::get('/posts/show/{id}', [PostController::class, 'show'])->name('show');

Route::get('/posts/{post}', [PostController::class, 'edit'])->name('edit');

Route::put('/posts/{id}', [PostController::class, 'update'])->name('update');

Route::delete('posts/delete{id}', [PostController::class, ('destroy')])->name('delete');
