<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create(){
        return view('posts/create');
    }

    public function store(Request $request){
        $title = $request->title;
        $content = $request->content; 
        
        $request->validate([  //빈칸일 경우 제출되지 않도록 막아줌
            'title' => 'required|min:3',  //최소 3글자 이상
            'content' => 'required',
            'imageFile' => 'image|max:2000'
        ]);

        // // $post = new Post();
        // $post->title = $title;
        // $post->content = $content;

    }
}
