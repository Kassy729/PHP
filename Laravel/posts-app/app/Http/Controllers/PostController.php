<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function __construct()  //여기 지정된 모든 라우터들은 auth 미들웨어가 적용됨
    {
        $this->middleware(['auth'])->except(['home', 'index', 'show']); 
    }

    public function show(Request $request, $id){  //currentPage 정보를 
        $page = $request->page;
        $post = Post::find($id);
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

    public function store(Request $request){
        // $request->input('title');
        // $request->input('content');

        $title = $request->title;  
        $content = $request->content;

        $request->validate([  //빈칸일 경우 제출되지 않도록 막아줌
            'title' => 'required|min:3',  //최소 3글자 이상
            'content' => 'required'
        ]);

        // dd($request);

        //DB에 저장
        $post = new Post();  
        $post->title = $title;
        $post->content = $content;
        $post->user_id = Auth::user()->id; //유저 id를 얻어야함, 로그인한 사용자, 로그인해야만 게시글을 작성할수 있도록 함
        $post->save();

        
        //결과 뷰를 반환
        return redirect('/posts/index'); 
        // return view('posts.index');  //refresh 했을때 계속 게시글이 반복해서 올라감 
    }
}

// class Post extends Model{  //모델은 하나의 레코드
//     // protected $table = 'my_posts';
//     use HasFactory;
// }


