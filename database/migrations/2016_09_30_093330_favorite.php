<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Favorite extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 收藏夹表

        Schema::create('favorite_directories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('user_id')->default(0)->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        // 文章-收藏夹-关系表

        Schema::create('favorites', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('favorite_directory_id')->default(0)->unsigned();
            $table->integer('article_id')->default(0)->unsigned();
            $table->integer('user_id')->default(0)->unsigned();
            $table->timestamps();


            $table->foreign('article_id')->references('id')->on('articles')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('favorite_directory_id')->references('id')->on('favorite_directories')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unique(['article_id', 'favorite_directory_id']);
        });

        // 收藏夹关注表（用户关注收藏夹

        Schema::create('favorite_directory_stars', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('favorite_directory_id')->default(0)->unsigned();
            $table->integer('user_id')->default(0)->unsigned();
            $table->timestamps();


            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('favorite_directory_id')->references('id')->on('favorite_directories')
                ->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favorite_directory_stars');
        Schema::dropIfExists('favorites');
        Schema::dropIfExists('favorite_directories');
    }
}
