<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

// controller를 만들기 전에 php artisan make:controller PhotoController --resource를 입력하는데
// --resource는 이 컨트롤러는 각각의 resource에 해당하는 메소드들을 가지고 있다.
class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
            1. 게시글 리스트를 DB에서 읽어 와야지
            2. 게시글 목록 만들어주는 blade에 읽어온 데이터를 전달하고 실행.
        */
        // select * from posts order by created_at desc

        // $posts = Post::orderby('created_at', 'desc')->get();
        $posts = Post::latest()->paginate(5);


        return view('bbs.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bbs.create');
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

        // dd($request->all());
        $input = array_merge(
            $request->all(),
            ["user_id" => Auth::user()->id]
        );
        //이미지가 있으면.. $input에 image 항목 추가

        $fileName = null;
        if ($request->hasFile('image')) {
            // dd($request->file('image'));
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/images', $fileName);

            // dd($path);
        };

        if ($fileName) {
            $input = array_merge($input, ['image' => $fileName]);
            // dd($input);
        }


        // user_id 의 내용을 $request 와 함께 합친다
        // mass assignment
        // Eloquent model의 white list 인 $fillable에 기술해야 한다.
        Post::create($input);

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $id에 해당하는 Post를 데이터베이스에서 인출
        // 그 놈을 상세보기 뷰로 전달한다.
        $post = Post::with('likes')->find($id);
        return view('bbs.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$id에 해당하는 포스트를 수정할 수 있는
        //페이지를 반환해주면 된다.
        return view('bbs.edit', ['post' => Post::find($id)]);
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
        // $post->title = $request->input['title'];  같은 기능
        $post->title = $request->title;
        $post->content = $request->content;
        // $request 객체 안에 이미지가 있으면,
        // 이 이미지를 이 게시글의 이미지로 변경하겠다는 의미
        if ($request->image) {
            // 이 이미지를 이 게시글의 이미지로 파일 시스템에
            // 저장하고, DB에 반영하기 전에
            // 그 이미지를 파일 시스템에서 삭제해줘야 한다.
            if ($post->image) {
                Storage::delete('public/images/' . $post->image);
            }
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $post->image = $fileName;
            $request->image->storeAs('public/images/', $fileName);
        }
        $post->save();
        /* update posts set title = $request->title,
                        content = $request->content,
                        image = $fileName,
                        updated_at = now(),
            where id = $id;
        */

        // $post->update(['title' => $request->title, 'content' => $request->content]);
        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //DI, Dependency Injection, 의존성 주입
        $post = Post::find($id);

        //게시글에 딸린 이미지가 있으면 파일시스템에서도 삭제해줘야 한다.
        if ($post->image) {
            Storage::delete('public/images/' . $post->image);
        }

        $post->delete();
        return redirect()->route('posts.index');
    }

    public function deleteImage($id)
    {
        $post = Post::find($id);
        Storage::delete(['public/images', '$post->image']);
        $post->image = null;
        $post->save();

        return redirect()->route('posts.edit', ['post' => $post->id]);
    }
}
