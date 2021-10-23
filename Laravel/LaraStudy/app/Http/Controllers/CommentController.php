<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $post_id)
    {
        // $comment = new Comment;
        // $comment->user_id = auth()->user()->id;
        // $comment->post_id = $post_id;
        // $comment->comment = $request->comment;

        // $comment->save();

        Comment::create([
            'comment' => $request->comment,
            'user_id' => auth()->user()->id,
            'post_id' => $post_id
        ]);

        // Comment::create($request->all());

        return 'success';
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

    public function update(Request $request, $comment_id)
    {
        $comment = $request->comment;
        $post = Comment::find($comment_id);
        /*
            select * from comments where id = ? *
        */

        $post->comment = $comment;
        $post->save();
    }
}
