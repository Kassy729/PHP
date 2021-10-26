<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        "comment",
        "post_id",
        "user_id"
    ];

    // protected $guarded = [
    //     'user_id', 'post_id'
    // ];  //디비에 못들어가게끔 막음

    use HasFactory;  //trait

    public function user()
    {
        //Comment입장에서 연결된 User을 찾을 때
        //belongsTo 관계를 메서드를 통해서
        //연결시켜주면 된다.
        return $this->belongsTo(User::class, 'user_id', 'id', 'users');
        /*
            SELECT *
            FROM USERS
            WHERE id = this.user_id
        */
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
