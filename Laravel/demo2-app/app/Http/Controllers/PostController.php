<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class PostController extends Controller
{
    public function create()
    {
        return view('posts/create');
    }

    public function store(Request $request)
    {
        $title = $request->title;
        $content = $request->content;

        $request->validate([
            'title' => 'required|min:3',
            'content' => 'required'
        ]);

        $post = new Post();
        $post->title = $title;
        $post->content = $content;
        $post->user_id = Auth::user()->id;

        if ($request->file('imageFile')) {
            $post->image = $this->uploadPostImage($request);
        }
        $post->save();

        return redirect('/posts/index');
    }

    public function index()
    {
        $posts = Post::latest()->paginate(4);
        return view('posts.index', compact('posts'));
    }

    public function myindex()
    {
        $id = Auth::user()->id;

        $posts = Post::where('user_id', $id)->latest()->paginate(5);

        // dd($posts);

        return view('posts.my_index', compact('posts'));
    }

    public function show(Request $request, $id)
    {
        $page = $request->page;
        $post = Post::find($id);
        return view('posts.show', compact('post', 'page'));
    }

    public function edit(Post $post)
    {
        return view('posts.edit')->with('post', $post);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:3',
            'content' => 'required',
            'imageFile' => 'image|max:2000'
        ]);

        $post = Post::find($id);

        $post->title = $request->title;
        $post->content = $request->content;

        if ($request->file('imageFile')) {
            $imagePath = 'public/images/' . $post->image;
            Storage::delete($imagePath);
            $post->image = $this->uploadPostImage($request);
        }
        $post->save();

        return redirect()->route('show', ['id' => $id]);
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();

        return redirect('/posts/index');
    }




    protected function uploadPostImage($request)
    {
        $name = $request->file('imageFile')->getClientOriginalName();
        $extension = $request->file('imageFile')->extension();
        $nameWithoutExtension = Str::of($name)->basename('.' . $extension);
        //????
        $fileName = $nameWithoutExtension . '_' . time() . '.' . $extension;
        //????
        $request->file('imageFile')->storeAs('public/images', $fileName);

        return $fileName;
    }
}
