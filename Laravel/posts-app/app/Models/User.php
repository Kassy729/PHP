<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Scout\Searchable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;


    protected $table = "users";  //클래스가 User라서 관례를 따랐기때문에 안적어도 괜찮아요

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts(){
        return $this->hasMany(Post::class);  //외래키를 적어야 하지만 관례를 따라서 생략 가능
    }

    public function viewed_posts(){
        // return $this->belongsToMany(Post::class);
        return $this->belongsToMany(Post::class, 'post_user', 'user_id', 'post_id', 'id', 'id', 'posts');  //users는 본인이라 사용하지않음
    }

    // use Searchable;

    // public function getScoutKey(){
    //     return $this->email;
    // }

    // public function getScoutKeyName(){
    //     return 'email';
    // }
}
