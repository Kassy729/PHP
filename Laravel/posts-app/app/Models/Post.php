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

    // use Searchable;

    // public function searchableAs()
    // {
    //     $array = $this->toArray();
        

    //     return 'posts_index';
    // }

}

