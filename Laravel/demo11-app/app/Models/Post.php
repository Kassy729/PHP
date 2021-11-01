<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "content",
        "user_id",
        "image"
    ];

    public function user()
    {
        // User와 Post의 관계 정의
        // 1:n 관계
        // User은 hasMany
        // Post는 belongsto
        return $this->belongsTo(User::class);
        // 함수를 정의할 때 이름을 테이블 이름을 따오면 따로 외래키를 줄 필요가 없다.
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class);
    }
}
