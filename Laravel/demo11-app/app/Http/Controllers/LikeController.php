<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Post $post)
    {  //타입을 지정해주면 find 하지 않아도 찾아준다
        // $post = Post::find($post);
        // return $post->likes()->toggle(auth()->user());

        return $post->likes()->toggle(auth()->user());
        /*toggle이란?
        로그인된 사용자의 좋아요/좋아요취소 요청처리
        */
    }

    public function my_index()
    {
        // $posts = auth()->user()->posts->pageinate(); auth()는 전역 함수

        // return view('posts.index', compact('posts'));
        $id = Auth::user()->id;

        $posts = Post::where('user_id', $id)->latest()->paginate(5);

        // dd($posts);

        return view('posts.my_index', compact('posts'));
    }
}
