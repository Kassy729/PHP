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
    return view('welcome');
});
//public 폴더안에 views 안에 있는 welcome파일을 열어주세요

Route::get('/test', function(){
    return 'Welcome !!!!';
});

Route::get('/test2', function(){
    return view('test.index');
});

Route::get('/test3', function(){
    // 비즈니스 로직 처리 
    $name = '홍길동';
    $age = 20;
    // return view('test.show', ['name'=>$name, 'age'=>10]);
    return view('test.show', compact('name', 'age'));
});

Route::prefix('/posts')->group(function(){

    Route::get('/create', [PostsController::class, 'create']);  //create를 통해 store로 연결

    Route::get('/edit', [PostsController::class, 'edit']);  //update로 연결

    Route::get('/index', [PostsController::class, 'index']); //read 부분
    
    Route::patch('/update', [PostsController::class, 'update']);  //update 부분

    Route::get('/{postId}', [PostsController::class, 'show']);  //read 부분, 와일드카드 최대한 아래에 위치
    
    Route::delete('/{postId}', [PostsController::class, 'delete']);  //delete 부분
    

});



