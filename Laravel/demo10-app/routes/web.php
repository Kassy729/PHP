<?php

use App\Http\Controllers\CommentsController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('/posts', PostsController::class)->middleware(['auth']);

Route::post('/comment/{post_id}', [CommentsController::class, 'store'])->middleware(['auth']);

Route::get('/comment/{post_id}', [CommentsController::class, 'index'])->middleware(['auth']);

Route::delete('/comment/{comment_id}', [CommentsController::class, 'destroy'])->middleware(['auth']);

require __DIR__ . '/auth.php';
