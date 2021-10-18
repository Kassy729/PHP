<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $id)
    {
        $comment = $request->comment;
        $post = new Comment();

        $post->content = $comment;
        $post->user_id = Auth::user()->id;
        $post->post_id = $id;

        $post->save();
    }
}
