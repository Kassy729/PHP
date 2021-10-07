<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LikesController extends Controller
{
    /*
        1. 로그인된 사용자의 좋아요/좋아요취소 요청 처리
    */

    // public function store($postId){
    //     $post = Post::find($postId)
    // }

    public function store(Post $post)
    {  //타입을 지정해주면 find 하지 않아도 찾아준다
        $post->likes()->toggle(auth()->user());
    }
}
