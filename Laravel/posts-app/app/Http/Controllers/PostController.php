<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $post->count++;  //조회수 증가 시킴
        $post->save();  //DB에 반영

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

    

    public function edit(Request $request, Post $post){  //라라벨 능력으로 Post로 바로 값을 가져와서 find 하지 않아도 된다
        // $post = Post::find($id);
        // $post = Post::where('id', $id)->first();
        //수정 폼 생성
        return view('posts.edit', ['post'=>$post, 'page'=>$request->page]);
    }

    public function update(Request $request, $id){
        $request->validate([  //빈칸일 경우 제출되지 않도록 막아줌
            'title' => 'required|min:3',  //최소 3글자 이상
            'content' => 'required',
            'imageFile' => 'image|max:2000'
        ]);

        $post = Post::find($id);  
        //이미지 파일 수정. 파일시스템에서    
        //게시글을 데이터베이스에서 수정
        $post->title=$request->title;
        $post->content=$request->content;

        //Authorization 즉 수정 권한이 있는지 검사
        //즉, 로그인한 사용자와 게시글의 작성자가 같은지 체크
        // if(auth()->user()->id != $post->user_id){
        //     abort(403);
        // }

        if($request->user()->cannot('update', $post)){
            abort(403);
        }

        if($request->file('imageFile')){  //nullException 방지
            $imagePath = 'public/images/'.$post->image;
            Storage::delete($imagePath); 
            $post->image = $this->uploadPostImage($request);
        }
        $post->save();

        

        return redirect()->route('post.show', ['id'=>$id, 'page'=>$request->page]);  //페이지 정보를 같이 줘야함 페이지 정보를 계속 물고 가야함
    }


    public function destroy(Request $request, $id){  //page정보도 같이 넘겨주어서 삭제후 그 페이지를 유지한다
        //파일 시스템에서 이미지 파일 삭제
        //게시글을 데이터베이스에서 삭제
        $post = Post::findOrFail($id);  //찾고 없으면 에러


        //Authorization 즉 수정 권한이 있는지 검사
        //즉, 로그인한 사용자와 게시글의 작성자가 같은지 체크
        // if(auth()->user()->id != $post->user_id){
        //     abort(403);
        // }

        if($request->user()->cannot('delete', $post)){
            abort(403);
        }

        $page = $request->page;
        if($post->image){
            $imagePath = 'public/images/'.$post->image;
            Storage::delete($imagePath); 
        }
        $post->delete();

        return redirect()->route('posts.index', ['page'=>$page]);
    }

    public function my_index(){
        // $posts = auth()->user()->posts->pageinate(); auth()는 전역 함수

        // return view('posts.index', compact('posts'));
        $id = Auth::user()->id;

        $posts = Post::where('user_id', $id)-> latest() -> paginate(5);

        return view('posts.my_index', compact('posts'));
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


