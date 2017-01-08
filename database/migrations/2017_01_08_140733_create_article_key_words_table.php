<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleKeyWordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_key_words', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('key_words_id')->default(0)->unsigned();
            $table->integer('article_id')->default(0)->unsigned();
            $table->integer('pos');
            $table->timestamps();

            $table->foreign('article_id')->references('id')->on('articles')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('key_words_id')->references('id')->on('key_words')
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
        Schema::dropIfExists('article_key_words');
    }
}
