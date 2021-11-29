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
        // $comment = Comment::where('post_id', $postId)->latest();
        $comments = Comment::with('user')->where('post_id', $postId)->latest()->paginate(3);
        return $comments;
    }

    public function update(Request $request, $comment_id)
    {
        $request->validate(['comment' => 'required']);

        $comment = Comment::find($comment_id);
        /*
            select * from comments where id = ? *
        */

        $this->authorize('update', $comment);
        // update set comment=? from comments where
        // id = ?
        // 첫번째 ? : $request -> input('comment')
        // 두번째 ? : $comment -> id

        $comment->update(
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


        // CommentPolicy를 적용한 권한관리를 하자.
        // 즉 이 요청을 한 사용자가 이 댓글을 삭제할 수 있는지
        // 체크하자.
        $this->authorize('delete', $comment);
        // if ($request->user()->cannot('delete', $comment)) {
        //     $comment->delete();
        //     return $comment;
        // } else {
        //     // 로그인한 사용자가 삭제 권한이 없는 경우
        //     abort(403);
        // }
        return $comment->delete();
    }
}
