<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class PostController extends Controller
{
    public function create(){
        return view('posts.create');
    }

    public function store(Request $request){
        $title = $request->title;
        $content = $request->content;

        $request->validate([  //빈칸일 경우 제출되지 않도록 막아줌
            'title' => 'required|min:3',  //최소 3글자 이상
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

        // return redirect('/posts.index');

    }

    protected function uploadPostImage($request){
        $name = $request->file('imageFile')->getClientOriginalName();
        
        $extension = $request->file('imageFile')->extension();
        // spaceship.jpg
        // spaceship_123kdsfasdf.jpg
            
        $nameWithoutExtension = Str::of($name)->basename('.'.$extension);
        // dd($nameWithoutExtension);
        $fileName = $nameWithoutExtension . '_' . time() . '.' . $extension;  
        //다른사람과 같은 이름의 jpg를 올렸을 경우 겹칠수 있어서 뒤에 time()을 붙여서 이름을 다르게 올려준다
        // dd($fileName);
        $request->file('imageFile')->storeAs('public/images', $fileName);
        //그 파일 이름을 컬럼에 설정

        return $fileName;
    }
}
