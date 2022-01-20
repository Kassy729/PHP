<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'title' => 'required',
                'content' => 'required|min:3'
            ]
        );

        $userId = $request->id;

        $input = array_merge(
            $request->all(),
            ["user_id" => $userId]
        );

        Post::create($input);

        return "success";
    }

    public function index()
    {
        $posts = Post::latest()->paginate(5);
        return $posts;
    }

    public function show($id)
    {
        $post = Post::with(['user'])->find($id);
        return $post;
    }
}
