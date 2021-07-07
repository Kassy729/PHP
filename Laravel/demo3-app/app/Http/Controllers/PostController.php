<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class PostController extends Controller
{
    public function create(){
        return view('posts/create');
    }

    public function store(Request $request){
        $title = $request->title;
        $content = $request->content;

        $request->validate([
            'title' => 'required|min:3',
            'content' => 'required',
            'imageFile' => 'image|max:2000'
        ]);

        
        $post = new Post();
        $post->title = $title;
        $post->content = $content;
        $post->user_id = Auth::user()->id;
        
        if($request->file('imageFile')){
            $post->image=$this->uploadPostImage($request);
        }
        $post->save();

        return redirect('/posts/index');
    }

    public function index(){
        $posts = Post::latest()->paginate(4);  //Post클래스 정보를 $posts변수에 담는다
        return view('posts.index', compact('posts'));
    }

    public function show(Request $request, $id){
        $page = $request->page;
        $post = Post::find($id);
        return view('posts.show', compact('post', 'page'));
    }

    public function edit(Request $request, Post $post){
        return view('posts.edit', ['post'=>$post, 'page'=>$request->page]);
    }

    public function update(Request $request, $id){
        $request->validate([  //빈칸일 경우 제출되지 않도록 막아줌
            'title' => 'required|min:3',  //최소 3글자 이상
            'content' => 'required',
            'imageFile' => 'image|max:2000'
        ]);

        $post = Post::find($id);
        $post->title=$request->title;
        $post->content=$request->content;

        if($request->user()->cannot('update', $post)){
            abort(403);
        }

        if($request->file('imageFile')){
            $imagePath = 'public/images/'.$post->image;
            Storage::delete($imagePath);
            $post->image = $this->uploadPostImage($request);
        }
        $post->save();

        return redirect()->route('posts.show', ['id'=>$id, 'page'=>$request->page]);
    }

    public function destroy(Request $request, $id){

    }


    protected function uploadPostImage($request){
        $name = $request->file('imageFile')->getClientOriginalName();
        $extension = $request->file('imageFile')->extension();
        $nameWithoutExtension = Str::of($name)->basename('.'.$extension);
        $fileName = $nameWithoutExtension . '_' . time() . '.' . $extension;
        $request->file('imageFile')->storeAs('public/images', $fileName);

        return $fileName;
    }
}
