<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;



class PostController extends Controller
{
    public function __construct(){
        $this->middleware(['auth'])->except(['home', 'index', 'show']);
    }

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
        $post -> title = $title;
        $post -> content = $content;
        $post -> user_id = Auth::user()->id;

        if($request->file('imageFile')){
            $post->image=$this->uploadPostImage($request);
        }
        $post->save();

        return redirect()->route('posts.index');
    }

    public function index(){
        $posts = Post::latest()->paginate(4);
        return view('posts/index', compact('posts'));
    }

    public function show(Request $request, $id){
        $page = $request->page;
        $post = Post::find($id);
        return view('posts.show', compact('post','page'));
    }

    protected function uploadPostImage($request){
        $name = $request->file('imageFile')->getClientOriginalName();

        $extension = $request->file('imageFile')->extension();
        $nameWithoutExtension = Str::of($name)->basename('.'.$extension);
        $fileName = $nameWithoutExtension.'_'.time().'.'.$extension;
        $request->file('imageFile')->storeAs('public/images', $fileName);

        return $fileName;
    }

}
