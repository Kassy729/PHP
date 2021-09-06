<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Monolog\Handler\RotatingFileHandler;

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

Route::get('/app', function () {
    return view('layouts.app');
});

Route::get('/hi', function () {
    return view('hello');
});

// Route::get('/post', [PostsController::class, 'index']);
// Route::get('/create', [PostsController::class, 'create']);
// Route::post('/store', [PostsController::class, 'store']);

Route::resource('/posts', PostController::class);
