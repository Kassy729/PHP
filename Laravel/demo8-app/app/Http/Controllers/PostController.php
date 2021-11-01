<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Event\RequestEvent;

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

    public function myindex()
    {
        $id = Auth::user()->id;

        $posts = Post::where('user_id', $id)->latest()->paginate(5);

        // dd($posts);

        return view('posts.myindex', ['posts' => $posts]);
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
        $this->validate(
            $request,
            [
                'title' => 'required',
                'content' => 'required|min:3'
            ]
        );

        $input = array_merge(
            $request->all(),
            ['user_id' => Auth::user()->id]
        );

        $fileName = null;

        if ($request->hasFile('image')) {
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/images', $fileName);
        };

        if ($fileName) {
            $input = array_merge($input, ['image' => $fileName]);
            // dd($input);
        }

        Post::create($input);

        return redirect()->route('post.index')->with('success', 1);
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

        return view('posts.show', ['post' => $post, 'page' => $page]);
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

        $post = Post::find($id);

        $title = $request->title;
        $content = $request->content;

        $post->title = $title;
        $post->content = $content;

        if ($request->user()->cannot('update', $post)) {
            abort(403);
        }

        $fileName = null;
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::delete('public/images' . '_' . $post->image);
            }
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $post->image = $fileName;
            $request->image->storeAs('public/images', $fileName);
        }


        $post->save();

        return redirect()->route('post.show', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $page = $request->page;
        $post = Post::find($id);

        if ($post->image) {
            Storage::delete('public/images/' . $post->image);
        }

        $post->delete();
        return redirect()->route('post.index', ['page' => $page]);
    }
}
