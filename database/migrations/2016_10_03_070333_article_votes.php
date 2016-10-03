<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ArticleVotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_votes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->default(0)->unsigned();
            $table->integer('article_id')->default(0)->unsigned();

            // 正负值
            $table->tinyInteger('vote')->default(0);
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
        Schema::dropIfExists('article_votes');
    }
}
