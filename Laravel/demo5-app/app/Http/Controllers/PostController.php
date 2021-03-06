<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class PostController extends Controller
{

    public function __construct()  //여기 지정된 모든 라우터들은 auth 미들웨어가 적용됨
    {
        $this->middleware(['auth'])->except(['home', 'index', 'show']); 
    }

    public function show(Request $request, $id){  //currentPage 정보를 
        $page = $request->page;  //쿼리스트링에서 준건 request로 받아야한다
        $post = Post::find($id);
        // $post->count++;  //조회수 증가 시킴
        // $post->save();  //DB에 반영
        /*
        이 글을 조회한 사용자들 중에, 현재
        로그인한 사용자가 포함되어 있는지를 체크하고
        포함되어 있지 않으면 추가,
        포함되어 있으면 다음 단계로 넘어감.
        */

        // if (Auth::user() != null && $post->viewers->contains(Auth::user()) === false){  //포함하면
        //     $post->viewers()->attach(Auth::user()->id);  //피벗테이블에 attach로 넣어라(insert 느낌)

        // }

        if(Auth::user() != null && $post->viewers->contains(Auth::user()) === false){
            $post->viewers()->attach(Auth::user()->id);
        }

        return view('posts.show', compact('post', 'page'));  //$id를 $post에 담아서 compact로 보내줌, 페이지 정보도 같이 보내주어야함
    }

    public function home(){
        if(isset(Auth::user()->name)){
            $name = Auth::user()->name;
        }else $name =''; 
        return view('/home', compact('name'));
    }

    public function index(){
        // $posts = Post::all();
        // $posts = Post::orderBy('created_at', 'desc')->get();
        // $posts = Post::latest()->get();
        $posts = Post::latest()->paginate(4);  //Post클래스 정보를 $posts변수에 담는다
        // return $posts;
        // dd($posts[0]->created_at);
        return view('posts/index', compact('posts'));  //(posts.index)뷰로 데이터를 전달한다 
    }
    
    public function create(){
        return view('posts/create');
    }

    public function comment(Request $request, $id){
        $content = $request->content;
        $page = $request->page;

        $comment = new Comment();  
        $comment->content = $content;
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $id;

        $comment->save();

        return redirect()->route('posts.show', ['id'=>$id, 'page'=> $page]); 
        
    }

    public function comment_delete(Request $request, $id){
        $page = $request->page;
        $comment = DB::table('comments')->where('id', $id);
        
        $comment->delete();

        return redirect()->route('posts.show', ['id'=>$page]);
    }

    public function store(Request $request){
        // $request->input('title');
        // $request->input('content');

        $title = $request->title;  
        $content = $request->content;

        $request->validate([  //빈칸일 경우 제출되지 않도록 막아줌
            'title' => 'required|min:3',  //최소 3글자 이상
            'content' => 'required',
            'imageFile' => 'image|max:2000'
        ]);

        // dd($request);

        //DB에 저장
        $post = new Post();  
        $post->title = $title;
        $post->content = $content;
        $post->user_id = Auth::user()->id; //유저 id를 얻어야함, 로그인한 사용자, 로그인해야만 게시글을 작성할수 있도록 함

        //File 처리
        //내가 원하는 파일시스템 상의 위치에 원하는 이름으로 
        //파일을 저장하고
        if($request->file('imageFile')){ //nullException 방지
            $post->image=$this->uploadPostImage($request);
        }
        $post->save();

        
        //결과 뷰를 반환
        return redirect('/posts/index'); 
        // return view('posts.index');  //refresh 했을때 계속 게시글이 반복해서 올라감 
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

        if($request->file('imageFile')){  //nullException 방지
            $imagePath = 'public/images/'.$post->image;
            Storage::delete($imagePath); 
            $post->image = $this->uploadPostImage($request);
        }
        $post->save();

        return redirect()->route('posts.show', ['id'=>$id, 'page'=>$request->page]); 

    }

    public function destroy(Request $request, $id){
        $post = Post::findOrFail($id);

        // if($request->user()->cannot('delete', $post)){
        //     abort(403);
        // }

        $page = $request->page;
        if($post->image){
            $imagePath = 'public/images'.$post->image;
            Storage::delete($imagePath);
        }
        $post->delete();

        return redirect()->route('posts.index', ['page'=>$page]);
    }

    public function like(Request $request, $id){
        $page = $request->page;
        $post = Post::find($id);

        $like = Like::all()->where('post_id', '=', $id)->where('user_id', '=', auth()->user()->id)->first();

        if (Auth::user() != null && !$post->likes->contains(Auth::user())){  
            $post->likes()->attach(Auth::user()->id); 
        }
        else if(Auth::user() != null && $post->likes->contains(Auth::user())){
            $like->delete();
        }  

        return redirect()->route('posts.show', ['post'=>$post, 'page'=>$page, 'id'=>$id]);
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

// class Post extends Model{  //모델은 하나의 레코드
//     // protected $table = 'my_posts';
//     use HasFactory;
// }


