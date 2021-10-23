<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function index($post_id)
    {
        $comments = DB::select('select * from comments where :id = post_id', ['id' => $post_id]);
        return $comments;
    }
}
