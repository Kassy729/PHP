<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(5);

        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $title = $request->title;
        $content = $request->content;

        $post = new Post();
        $post->title = $title;
        $post->content = $content;
        $post->user_id = Auth::user()->id;

        // $fileName = null;
        // if ($request->hasFile('image')) {
        //     $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
        //     $request->file('image')->storeAs('public/images', $fileName);  //storeAs storage안에 app안에 지정된 경로에 파일 저장
        //     $post->image = $fileName;
        // }

        $fileName = null;
        if ($request->hasFile('image')) {
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/images', $fileName);
            $post->image = $fileName;
        }

        $post->save();
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $page = $request->page;
        $post = Post::with('likes')->find($id);
        return view('posts.show', compact('post', 'page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'title' => 'required',
                'content' => 'required|min:3'
            ]
        );

        $title = $request->title;
        $content = $request->content;

        $post = Post::find($id);
        $post->title = $title;
        $post->content = $content;

        if ($request->image) {
            if ($post->image) {
                Storage::delete(['public/storage/' . $post->image]);
            }
            $fileName = time() . '_' . $post->image;
            $request->image->storeAs('public/images', $fileName);
            $post->image = $fileName;
        }
        $post->save();

        return redirect()->route('posts.show', ['post' => $post]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $post = Post::find($id);

        $page = $request->page;

        $post->delete();
        return redirect()->route('posts.index', ['page' => $page]);
    }
}
