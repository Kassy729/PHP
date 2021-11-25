<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;  //trait

    protected $guarded = [];
    //fillable에 다 허용한다

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
