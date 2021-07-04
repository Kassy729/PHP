<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->mediumText('content');
            $table->string('image')->nullable();

            // $table->foreign('user_id')->references('id')->on('users');
            // $table->foreignId('user_id')->constrained('users');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // 관례를 따라 user테이블에 id라는 기본키를 참조한다는 것을 알 수 있다
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
