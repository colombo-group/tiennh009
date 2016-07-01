<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('title');
            $table->string('unsigned_title');
            $table->text('summary');
            $table->longText('content');
            $table->string('image');
            $table->integer('slide')->default(0);
            $table->integer('view')->default(0);
            $table->integer('like')->default(0);
            $table->integer('share')->default(0);
            $table->integer('cate_id')->unsigned();
            $table->foreign('cate_id')->references('id')->on('categories');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::drop('posts');
    }
}
