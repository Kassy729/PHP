<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use HasFactory;

    public function imagePath(){
        $path = env('IMAGE_PATH', '/storage/images');
        $imageFile = $this->image ?? 'frog.jpg';
        return $path.$imageFile;
    }

    public function user(){
        return $this->belongsTo(User::class);  //users 테이블
    }

    public function viewers(){
        return $this->belongsToMany(User::class, 'post_user', 'post_id', 'user_id', 'id', 'id', 'users');  //'posts는 본인이라 안써줘도 됨'
    }

    public function likes(){
        return $this->belongsToMany(User::class, 'likes', 'post_id', 'user_id', 'id', 'id', 'users');  //외래키를 적어야 하지만 관례를 따라서 생략 가능
    }

    public function comments(){
        return $this->hasMany(Comment::class);  //외래키를 적어야 하지만 관례를 따라서 생략 가능
    }

    


    // use Searchable;

    // public function searchableAs()
    // {
    //     $array = $this->toArray();
        

    //     return 'posts_index';
    // }

}

