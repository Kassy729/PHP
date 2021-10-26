<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
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

        return back();
    }

    public function index($post_id)
    {
        // $comments = DB::select('select * from comments where :id = post_id', ['id' => $post_id]);
        $comments = Comment::where('post_id', $post_id)->with('user')->get();
        return $comments;
    }

    public function destroy($comment_id)
    {
        $comment = Comment::find($comment_id);
        $comment->delete();
        return $comment;
    }
}
