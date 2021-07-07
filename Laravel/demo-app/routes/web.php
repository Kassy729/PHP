<?php

use App\Http\Controllers\PostsController;
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



Route::get('posts/create', [PostsController::class,('create')])->name('create');
// ->middleware(['auth']);

Route::post('posts/store', [PostsController::class,('store')]);

Route::get('posts/index', [PostsController::class,('index')])->name('index');  //라우트에 이름을 준다 navigation.blade

Route::get('posts/show/{id}', [PostsController::class,('show')])->name('show');

Route::get('posts/edit/{id}', [PostsController::class,('edit')])->name('edit');

Route::put('posts/update{id}', [PostsController::class,('update')])->name('update');

Route::delete('posts/delete{id}', [PostsController::class,('destroy')])->name('delete');

require __DIR__.'/auth.php';
