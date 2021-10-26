<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //댓글 등록
    public function store(Request $request, $post_id)
    {
        // $comment = new Comment;
        // $comment->user_id = auth()->user()->id;
        // $comment->post_id = $post_id;
        // $comment->comment = $request->comment;

        // $comment->save();

        $request->validate(['comment' => ['required']]);

        //email검사도 가능
        // $request->validate(['email' => 'required|email|unique:comments']);

        // $this->validate($request, ['comment' => 'required']);

        // create에 사용할 수 있는 칼럼들은 Eloquent 모델 클래스에 $fillable에 명시되어 있어야 한다.
        // mss assignment
        $comment = Comment::create(
            [
                'comment' => $request->comment,
                'user_id' => auth()->user()->id,
                'post_id' => $post_id
            ]
        );

        // Comment::create($request->all());

        return $comment;
    }


    public function index($postId)
    {
        /*
            select * from comments where post_id = ?
        */
        $comment = Comment::where('post_id', $postId)->latest();
        return $comment;
    }

    public function update(Request $request, $comment_id)
    {
        $request->validate(['comment' => 'required']);

        $comment = Comment::find($comment_id);
        /*
            select * from comments where id = ? *
        */

        $comment::update(
            [
                'comment' => $request->input('comment'),
            ]
        );

        return $comment;
    }

    public function destroy($comment_id)
    {
        /*
            comments 테이블에서 id가 $commentId인 레코드를 삭제
            1. RAW query
            2. DB Query Builder
            3. Eloquent
        */
        // delete from comments where id = ?
        $comment = Comment::find($comment_id);
        $comment->delete();

        return $comment;
    }
}
