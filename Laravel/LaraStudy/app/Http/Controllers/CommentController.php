<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        return $request;
        dd($request);
    }

    public function index_test(Post $post)
    {
        /*
            select *
            from comments
            where post_id = $post->id;
        */
        //Post 클래스에 comments 함수 구현한 경우 ...
        return $post->comments;
    }

    public function index($postId)
    {
        /*
            select * from comments where post_id = ?
        */
        $comment = Comment::where('post_id', $postId)->latest();
    }
}
