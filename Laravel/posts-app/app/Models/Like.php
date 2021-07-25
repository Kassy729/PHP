<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $table='likes';
    public $timestamps = false;


    public function post(){  //왜 포스트랑만 관계를 정의한걸까?
        return $this->belongsTo(Post::class);
    }
    
}
