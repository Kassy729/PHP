<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function create(){
        return view('posts/create');
    }

    public function store(Request $request){
        $name = $request->input('name');
    }

    public function edit(){
        return view('posts/edit');
    }

    public function update(){
        //업데이트 구문
    }

    public function delete(){

    }

    

}
