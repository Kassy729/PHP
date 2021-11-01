<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentsController extends Controller
{
    public function store(Request $request, $post_id)
    {
        $request->validate(['comment' => ['required']]);
        //정당성 검사

        $comment = Comment::create(
            [
                'comment' => $request->comment,
                'user_id' => auth()->user()->id,
                'post_id' => $post_id
            ]
        );
        //모델에 fillable 정의 해줘야함

        return $comment;
    }

    public function index($post_id)
    {
        $comments = Comment::where('post_id', $post_id)->with('user')->get();
        return $comments;
    }
}
